<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;

test('it can generate a global set class', function (): void {
    $name = 'FooterGlobal';
    $this->artisan('make:global-set', ['name' => $name]);

    $path = app_path('Globals/FooterGlobal.php');

    expect(File::exists($path))->toBeTrue();

    $content = File::get($path);

    expect($content)->toContain('class FooterGlobal extends BaseGlobalSet');
    expect($content)->toContain("return 'footer_global';");
    expect($content)->toContain('public function title(): string');
    expect($content)->toContain("return 'FooterGlobal';");
    expect($content)->toContain('public function sites(): array');

    File::deleteDirectory(app_path('Globals'));
});
