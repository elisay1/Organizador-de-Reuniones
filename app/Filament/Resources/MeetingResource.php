<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetingResource\Pages;
use App\Filament\Resources\MeetingResource\RelationManagers;
use App\Models\Meeting;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;
use DateTime;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Components\Section;

class MeetingResource extends Resource
{
    protected static ?string $model = Meeting::class;

    protected static ?string $modelLabel = 'reunión'; // Este cambia el nombre de la barra
    protected static ?string $pluralLabel = 'reuniones';  // Este cambia el lenguaje a plural en la tabla

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days'; // https://heroicons.com/ para cambiar los iconos

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Requiere un objeto de tipo form
                Select::make('user_id')
                    ->label('Usuario') //cambia el nombre
                    ->placeholder('Seleccione un usuario') //cambia el placeholder
                    ->relationship('user', 'name')
                    ->required(), //campo requerido 
                DateTimePicker::make('meeting_date')
                    ->label('Fecha de la reunión')
                    ->minDate(now()) //Esto es una validacion para que solo pueda crear fecha desde el dia que esta para delante y no antes
                    ->required(),
                Forms\Components\TextInput::make('subject')
                    ->label('Asunto')
                    ->required()
                    ->columnSpan('full'), //Esto es para que tenga todo el tamaño posible
                Forms\Components\Textarea::make('details')
                    ->label('Detalles')
                    //->nullable()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->url() //validacion de las urls
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('client_name')
                    ->label('Nombre del cliente')
                    ->required(),
                Forms\Components\TextInput::make('client_email')
                    ->label('Correo del cliente')
                    ->email() //este para que interprete el correo @
                    ->required(),


                // 'user_id',
                // 'meeting_date',
                // 'subject',
                // 'meeting_status',
                // 'details',
                // 'url',
                // 'minutes',
                // 'client_name',
                // 'client_email',  
                // ->options(
                //     User::all()->pluck('name', 'id')
                // ),

            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
        Section::make('Informacion de la reunión')//Esto nos permite ver en un card lña información
        ->schema([
            TextEntry::make('meeting_date')
                ->label('Fecha de la reunión'),
            TextEntry::make('subject')
                ->label('Asunto'),
            TextEntry::make('client_name')
                ->label('Nombre del cliente'),
            TextEntry::make('user.name')
                ->label('Usuario'),
            TextEntry::make('client_email')
                ->label('Correo del cliente'),
                TextEntry::make('url')
                ->label('URL'),
            TextEntry::make('meeting_status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'requested' => 'warning',
                    'accepted' => 'success',
                    'finished' => 'primary',
                    'cancelled' => 'danger',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'requested' => 'Solicitada',
                    'accepted' => 'Aceptada',
                    'finished' => 'Finalizada',
                    'cancelled' => 'Cancelada',
                })
                ->label('Estado'),
            ])->columns(3)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //Aca se pone las columnas  que se muestran en la tabla                
                TextColumn::make('meeting_date')
                    ->label('Fecha de la reunión'),
                TextColumn::make('subject')
                    ->label('Asunto')
                    ->wrap(),
                TextColumn::make('client_name')
                    ->label('Nombre del cliente'),
                TextColumn::make('user.name') //aca llamamos ala relacion
                    ->label('Usuario'),
                TextColumn::make('client_email')
                    ->label('Correo del cliente'),
                TextColumn::make('meeting_status')
                    ->badge() //Esto es para darle color
                    ->color(fn (string $state): string => match ($state) { //para ponerle colores 
                        'requested' => 'warning',
                        'accepted' => 'success',
                        'finished' => 'primary',
                        'cancelled' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) { //para ponerle los nombres apropiados
                        'requested' => 'Solicitada',
                        'accepted' => 'Aceptada',
                        'finished' => 'Finalizada',
                        'cancelled' => 'Cancelada',
                    })
                    ->label('Estado'),                   
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->label('Ver'),                
                Tables\Actions\EditAction::make()
                ->label('Editar'),
                Tables\Actions\DeleteAction::make()
                ->Label('Eliminar'),
            ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->emptyStateDescription('Cree una reunion para empezar');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeetings::route('/'),
            'create' => Pages\CreateMeeting::route('/create'),
            'view' => Pages\ViewMeeting::route('/{record}'),
            'edit' => Pages\EditMeeting::route('/{record}/edit'),
        ];
    }
}
