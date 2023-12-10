<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BossResource\Pages;
use App\Filament\Resources\BossResource\RelationManagers;
use App\Models\Boss;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BossResource extends Resource
{
    protected static ?string $model = Boss::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('region')
                    ->options([
                        'kanto' => 'Kanto',
                        'johto' => 'Johto',
                        'hoenn' => 'Hoenn',
                        'sinnoh' => 'Sinnoh',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cooldown')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('rewards')
                    ->toolbarButtons([
                        'bold','italic','link','orderedList','bulletList'
                    ]),
                Forms\Components\RichEditor::make('notes')
                    ->toolbarButtons([
                        'bold','italic','link','orderedList','bulletList'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('region')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\TextColumn::make('cooldown'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListBosses::route('/'),
            'create' => Pages\CreateBoss::route('/create'),
            'edit' => Pages\EditBoss::route('/{record}/edit'),
        ];
    }    
}
