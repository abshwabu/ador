<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

/**
 * @property-read Schema $form
 */
class ManageSettings extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Homepage Settings';

    protected static ?string $title = 'Homepage Settings';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.manage-settings';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::instance();
        $this->form->fill($setting->attributesToArray());
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->model(Setting::instance());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Settings')
                    ->tabs([
                        Tab::make('Brand')
                            ->icon('heroicon-o-building-office-2')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('company_name')
                                        ->label('Company Name')
                                        ->required(),
                                    TextInput::make('short_name')
                                        ->label('Short Name'),
                                    TextInput::make('tagline')
                                        ->label('Tagline')
                                        ->columnSpan(2),
                                    FileUpload::make('logo')
                                        ->label('Logo')
                                        ->image()
                                        ->disk('public')
                                        ->directory('branding'),
                                    FileUpload::make('favicon')
                                        ->label('Favicon')
                                        ->image()
                                        ->disk('public')
                                        ->directory('branding'),
                                ]),
                            ]),

                        Tab::make('Hero')
                            ->icon('heroicon-o-sparkles')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextInput::make('hero_kicker')
                                        ->label('Hero Kicker')
                                        ->columnSpan(3),
                                    TextInput::make('hero_heading_line1')
                                        ->label('Heading Line 1'),
                                    TextInput::make('hero_heading_line2')
                                        ->label('Heading Line 2'),
                                    TextInput::make('hero_heading_line3')
                                        ->label('Heading Line 3'),
                                    Textarea::make('hero_paragraph')
                                        ->label('Hero Paragraph')
                                        ->rows(3)
                                        ->columnSpan(3),
                                    TextInput::make('hero_primary_button_text')
                                        ->label('Primary Button Text'),
                                    TextInput::make('hero_primary_button_link')
                                        ->label('Primary Button Link'),
                                    FileUpload::make('hero_image')
                                        ->label('Hero Image')
                                        ->image()
                                        ->disk('public')
                                        ->directory('hero'),
                                    TextInput::make('hero_secondary_button_text')
                                        ->label('Secondary Button Text'),
                                    TextInput::make('hero_secondary_button_link')
                                        ->label('Secondary Button Link'),
                                    TextInput::make('hero_badge_title')
                                        ->label('Badge Title'),
                                    TextInput::make('hero_badge_text')
                                        ->label('Badge Subtext')
                                        ->columnSpan(2),
                                ]),
                            ]),

                        Tab::make('About')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('about_kicker')
                                        ->label('Kicker'),
                                    TextInput::make('about_heading')
                                        ->label('Heading'),
                                    Textarea::make('about_body')
                                        ->label('Body')
                                        ->rows(4)
                                        ->columnSpan(2),
                                    FileUpload::make('about_image')
                                        ->label('About Image')
                                        ->image()
                                        ->disk('public')
                                        ->directory('about')
                                        ->columnSpan(2),
                                ]),
                            ]),

                        Tab::make('Process')
                            ->icon('heroicon-o-arrow-path')
                            ->schema([
                                TextInput::make('process_kicker')
                                    ->label('Kicker'),
                                TextInput::make('process_heading')
                                    ->label('Heading'),
                                Textarea::make('process_intro')
                                    ->label('Intro Text')
                                    ->rows(3),
                            ]),

                        Tab::make('Team')
                            ->icon('heroicon-o-users')
                            ->schema([
                                TextInput::make('team_kicker')
                                    ->label('Kicker'),
                                TextInput::make('team_heading')
                                    ->label('Heading'),
                                Textarea::make('team_intro')
                                    ->label('Intro Text')
                                    ->rows(3),
                            ]),

                        Tab::make('Quote/CTA')
                            ->icon('heroicon-o-chat-bubble-bottom-center-text')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('quote_kicker')
                                        ->label('Kicker'),
                                    TextInput::make('quote_heading')
                                        ->label('Heading'),
                                    Textarea::make('quote_text')
                                        ->label('Banner Text')
                                        ->rows(3)
                                        ->columnSpan(2),
                                    TextInput::make('quote_button_text')
                                        ->label('Button Text'),
                                    TextInput::make('quote_button_link')
                                        ->label('Button Link'),
                                ]),
                            ]),

                        Tab::make('Contact')
                            ->icon('heroicon-o-envelope')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('contact_kicker')
                                        ->label('Kicker'),
                                    TextInput::make('contact_heading')
                                        ->label('Heading'),
                                    Textarea::make('contact_intro')
                                        ->label('Intro Text')
                                        ->rows(2)
                                        ->columnSpan(2),
                                    TextInput::make('contact_company')
                                        ->label('Company Name'),
                                    TextInput::make('contact_address')
                                        ->label('Address / Location'),
                                    TextInput::make('contact_phone')
                                        ->label('Phone / WhatsApp'),
                                    TextInput::make('contact_email')
                                        ->label('Email')
                                        ->email(),
                                ]),
                            ]),

                        Tab::make('Footer')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Textarea::make('footer_about')
                                    ->label('Footer About Text')
                                    ->rows(3),
                                TextInput::make('footer_copyright')
                                    ->label('Copyright Line'),
                            ]),

                        Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Meta Title'),
                                Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->rows(3),
                            ]),
                    ]),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFormContentComponent(),
            ]);
    }

    public function getFormContentComponent(): Component
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler('save')
            ->footer([
                Actions::make($this->getFormActions()),
            ]);
    }

    /**
     * @return array<Action>
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Settings')
                ->submit('save')
                ->keyBindings(['mod+s']),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $setting = Setting::instance();
        $setting->update($data);

        Notification::make()
            ->title('Settings saved successfully.')
            ->success()
            ->send();
    }
}
