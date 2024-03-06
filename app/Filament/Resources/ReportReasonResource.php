<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportReasonResource\Pages;
use App\Filament\Resources\ReportReasonResource\RelationManagers;
use App\Models\ReportReason;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportReasonResource extends Resource
{
    protected static ?string $model = ReportReason::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('reason')
                ->required(),
                TextInput::make('reason_translate')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('reason'),
                TextColumn::make('reason_translate'),
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
            'index' => Pages\ListReportReasons::route('/'),
            'create' => Pages\CreateReportReason::route('/create'),
            'edit' => Pages\EditReportReason::route('/{record}/edit'),
        ];
    }    
}
