<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('nama_service')
                    ->label('Nama Layanan')
                    ->required()
                    ->options([
                        'Standard Shipping' => 'Standard Shipping',
                        'International Shipping' => 'International Shipping',
                        'Express Delivery' => 'Express Delivery',
                        'SwaBig' => 'SwaBig',
                        'Business Delivery' => 'Business Delivery',
                        'Custom Logistics' => 'Custom Logistics',
                    ])
                    ->live()
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state === 'Standard Shipping') {
                            $set('harga', 20000);
                        } elseif ($state === 'International Shipping') {
                            $set('harga', 80000);
                        } elseif ($state === 'Express Delivery') {
                            $set('harga', 50000);
                        } elseif ($state === 'SwaBig') {
                            $set('harga', 100000);
                        } elseif ($state === 'Business Delivery') {
                            $set('harga', 30000);
                        } elseif ($state === 'Custom Logistics') {
                            $set('harga', 40000);
                        }
                    }),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi'),

                Forms\Components\TextInput::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->required()
                    ->reactive(),

                Forms\Components\FileUpload::make('image_path')
                    ->label('Gambar/Ikon')
                    ->image()
                    ->disk('public')
                    ->directory('services')
                    ->nullable()
                    ->previewable(true)
                    ->imagePreviewHeight('150')
                    ->loadingIndicatorPosition('left')
                    ->uploadProgressIndicatorPosition('right')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Gambar')
                    ->disk('public')
                    ->getStateUsing(fn ($record) =>
                        $record->image_path
                            ? 'services/' . $record->image_path
                            : 'icons/flash.svg'
                    )
                    ->height(50)
                    ->circular(),

                Tables\Columns\TextColumn::make('nama_service')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->limit(30)
                    ->label('Deskripsi'),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
