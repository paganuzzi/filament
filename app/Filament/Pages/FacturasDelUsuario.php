<?php

namespace App\Filament\Pages;

use App\Models\Factura;
use Filament\Pages\Page;
use Filament\Tables\Table;

class FacturasDelUsuario extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Usuarios';

    protected static ?string $navigationLabel = 'Facturas del Usuario';

    protected static string $view = 'filament.pages.facturas-del-usuario';

    protected static ?string $model = Factura::class;

    public static function table(Table $table): Table
    {
        return $table;
    }
}
