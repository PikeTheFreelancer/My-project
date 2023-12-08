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
        $pokemonOptions = Http::get("https://pokeapi.co/api/v2/pokemon/?offset=0&limit=10100")->json()['results'];
        $pokemonMoves = Http::get("https://pokeapi.co/api/v2/move/?offset=0&limit=900")->json()['results'];
        $pokemonItems = Http::get("https://pokeapi.co/api/v2/item/?offset=0&limit=2000")->json()['results'];
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
                                ->getSearchResultsUsing(function (string $search) use($pokemonOptions) {
                                    $pokemons = [];
                                    $count = 0;
                                    foreach ($pokemonOptions as $result) {
    
                                        if (stripos($result['name'], $search) !== false) {
                                            $pokemons[$result['name']] = $result['name'];
                                            $count++;
                                        }
    
                                        //get 10 results maximum
                                        if ($count >= 10) {
                                            break;
                                        }
                                    }
                                    return $pokemons;
                                })
                                ->required()
                                ->columns(2),
                            
                            Forms\Components\Select::make('item')
                                ->searchable()
                                ->getSearchResultsUsing(function (string $search) use($pokemonItems) {
                                    $filterItems = [];
                                    $count = 0;
                                    foreach ($pokemonItems as $result) {

                                        if (stripos($result['name'], $search) !== false) {
                                            $filterItems[$result['name']] = $result['name'];
                                            $count++;
                                        }

                                        //get 10 results maximum
                                        if ($count >= 10) {
                                            break;
                                        }
                                    }
                                    return $filterItems;
                                })
                                ->columns(2),

                            Forms\Components\Select::make('moves')
                            ->multiple()
                            ->searchable()
                            ->getSearchResultsUsing(function (string $search) use($pokemonMoves) {
                                $filterMoves = [];
                                $count = 0;
                                foreach ($pokemonMoves as $result) {

                                    if (stripos($result['name'], $search) !== false) {
                                        $filterMoves[$result['name']] = $result['name'];
                                        $count++;
                                    }

                                    //get 10 results maximum
                                    if ($count >= 10) {
                                        break;
                                    }
                                }
                                return $filterMoves;
                            })
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
