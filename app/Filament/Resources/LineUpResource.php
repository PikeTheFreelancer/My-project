<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LineUpResource\Pages;
use App\Filament\Resources\LineUpResource\RelationManagers;
use App\Models\Boss;
use App\Models\LineUp;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Http;

class LineUpResource extends Resource
{
    protected static ?string $model = LineUp::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        $pokemonData = Http::get("https://pokeapi.co/api/v2/pokemon/?offset=0&limit=10100")->json()['results'];
        $pokemonMoves = Http::get("https://pokeapi.co/api/v2/move/?offset=0&limit=900")->json()['results'];
        $pokemonItems = Http::get("https://pokeapi.co/api/v2/item/?offset=0&limit=2000")->json()['results'];
        $pokemonNatures = Http::get("https://pokeapi.co/api/v2/nature/?offset=0&limit=30")->json()['results'];
        $pokemonAbilities = Http::get("https://pokeapi.co/api/v2/ability/?offset=0&limit=400")->json()['results'];
        $pokemonOptions = [];
        $natureOptions = [];
        $itemOptions = [];
        $moveOptions = [];
        $abiOptions = [];
        foreach ($pokemonNatures as $nature) {
            $natureOptions[$nature['name']] = $nature['name'];
        }
        foreach ($pokemonItems as $item) {
            $itemOptions[$item['name']] = $item['name'];
        }
        foreach ($pokemonData as $pokemon) {
            $pokemonOptions[$pokemon['name']] = $pokemon['name'];
        }
        foreach ($pokemonMoves as $move) {
            $moveOptions[$move['name']] = $move['name'];
        }
        foreach ($pokemonAbilities as $abi) {
            $abiOptions[$abi['name']] = $abi['name'];
        }
        return $form
            ->schema([
                Grid::make(2)->schema([
                    Forms\Components\Select::make('level')
                    ->options([
                        'hard' => 'Hard',
                        'medium' => 'Medium',
                        'easy' => 'Easy',
                    ])
                    ->required(),

                    Forms\Components\Select::make('boss_id')
                        ->label('Boss')
                        ->options(Boss::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                ]),
                Grid::make(2)->schema([
                    Forms\Components\Repeater::make('line_up')
                        ->schema([
                            Forms\Components\Select::make('pokemon')
                                ->searchable()
                                ->options($pokemonOptions)
                                ->required()
                                ->columns(2),

                            Forms\Components\Select::make('nature')
                            ->searchable()
                            ->options($natureOptions),
                            Forms\Components\Select::make('ability')
                            ->searchable()
                            ->options($abiOptions),
                            Forms\Components\Select::make('item')
                                ->searchable()
                                ->options($itemOptions)
                                ->columns(2),
                            
                            
                            Forms\Components\Select::make('moves')
                            ->multiple()
                            ->searchable()
                            ->options($moveOptions)
                            ->required()
                            ->columns(2),
                        ])
                        ->columnSpan(1)
                        ->required(),
                ]),
                Forms\Components\Textarea::make('rewards'),
                Forms\Components\Textarea::make('notes'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('level'),
                Tables\Columns\TextColumn::make('boss_id'),
                Tables\Columns\TextColumn::make('rewards'),
                Tables\Columns\TextColumn::make('notes'),
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
            'index' => Pages\ListLineUps::route('/'),
            'create' => Pages\CreateLineUp::route('/create'),
            'edit' => Pages\EditLineUp::route('/{record}/edit'),
        ];
    }    
}
