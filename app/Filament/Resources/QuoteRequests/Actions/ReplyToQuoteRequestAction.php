<?php

namespace App\Filament\Resources\QuoteRequests\Actions;

use App\Mail\QuoteRequestReplyMail;
use App\Models\QuoteRequest;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class ReplyToQuoteRequestAction
{
    public static function make(?string $name = 'reply'): Action
    {
        return Action::make($name)
            ->label('Reply')
            ->icon('heroicon-o-paper-airplane')
            ->color('warning')
            ->modalHeading(fn (QuoteRequest $record): string => "Reply to {$record->full_name}")
            ->modalDescription('Compose and send an email reply directly to this client from the admin panel.')
            ->modalSubmitActionLabel('Send Email Reply')
            ->schema([
                TextInput::make('recipient')
                    ->label('Client Email')
                    ->default(fn (QuoteRequest $record): string => $record->email ?? '')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('subject')
                    ->label('Subject')
                    ->default(fn (QuoteRequest $record): string => 'Re: Consultation Request - ' . ($record->company ? $record->company . ' / ' : '') . 'Adorn Trading PLC')
                    ->required()
                    ->maxLength(255),
                Textarea::make('message')
                    ->label('Reply Message')
                    ->placeholder("Dear client,\n\nThank you for reaching out regarding your project. We would be pleased to schedule a consultation...\n\nBest regards,\nAdorn Trading PLC Team")
                    ->rows(7)
                    ->required()
                    ->helperText(fn (QuoteRequest $record): string => 'This message will be emailed directly to ' . ($record->email ?? 'the client') . '.'),
            ])
            ->action(function (QuoteRequest $record, array $data): void {
                if (empty($record->email)) {
                    Notification::make()
                        ->title('Cannot send email')
                        ->body('This quote request does not have a client email address.')
                        ->danger()
                        ->send();
                    return;
                }

                try {
                    $currentUser = auth()->user();
                    $senderEmail = $currentUser?->email;
                    $senderName = $currentUser?->name;

                    Mail::to($record->email)->send(new QuoteRequestReplyMail(
                        quoteRequest: $record,
                        replySubject: $data['subject'],
                        replyMessage: $data['message'],
                        senderEmail: $senderEmail,
                        senderName: $senderName,
                    ));

                    if ($record->status === QuoteRequest::STATUS_NEW) {
                        $record->status = QuoteRequest::STATUS_CONTACTED;
                    }

                    $timestamp = now()->format('Y-m-d H:i');
                    $userName = $senderName ?: 'Admin';
                    $logEntry = "[{$timestamp}] Sent email reply by {$userName}:\nSubject: {$data['subject']}\n" . str($data['message'])->limit(150);
                    $record->admin_notes = $record->admin_notes ? ($record->admin_notes . "\n\n" . $logEntry) : $logEntry;
                    $record->save();

                    Notification::make()
                        ->title('Reply sent successfully')
                        ->body("Email has been sent to {$record->email}.")
                        ->success()
                        ->send();
                } catch (\Throwable $e) {
                    report($e);
                    Notification::make()
                        ->title('Failed to send reply')
                        ->body('Error sending email: ' . $e->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }
}
