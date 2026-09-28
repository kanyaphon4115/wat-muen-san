<?php

// Build the four public pages without publishing Laravel source or .env files.
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
config(['app.debug' => false, 'session.driver' => 'array', 'cache.default' => 'array']);
if (!config('app.key')) {
    config(['app.key' => 'base64:'.base64_encode(random_bytes(32))]);
}
$origin = 'https://static-export.invalid';
app('url')->forceRootUrl($origin);
app('url')->forceScheme('https');
app('url')->useAssetOrigin($origin);
$output = dirname(__DIR__).'/deploy-static';
if (!is_dir($output)) {
    mkdir($output, 0755, true);
}
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
foreach (['/' => 'index.html', '/tiger-legend' => 'tiger-legend.html', '/history' => 'history.html', '/places' => 'places.html'] as $path => $file) {
    $request = Illuminate\Http\Request::create($origin.$path);
    $response = $kernel->handle($request);
    if ($response->getStatusCode() !== 200) {
        throw new RuntimeException('Export failed: '.$path.' HTTP '.$response->getStatusCode());
    }
    $origins = [$origin];
    foreach ([1, 3] as $slashes) {
        $origins[] = str_replace('/', str_repeat(chr(92), $slashes).'/', $origin);
    }
    $html = str_replace($origins, '', $response->getContent());
    $html = str_replace('href=""', 'href="/"', $html);
    if (str_contains($html, 'localhost') || str_contains($html, 'static-export.invalid')) {
        preg_match('/.{0,50}(?:localhost|static-export\.invalid).{0,80}/', $html, $match);
        throw new RuntimeException('Local URL found in '.$path.': '.($match[0] ?? ''));
    }
    file_put_contents($output.'/'.$file, $html);
    $kernel->terminate($request, $response);
    echo "Exported $path\n";
}
$images = public_path('images');
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($images, FilesystemIterator::SKIP_DOTS)) as $image) {
    if (!in_array(strtolower($image->getExtension()), ['jpg', 'jpeg', 'png', 'svg', 'webp', 'gif', 'ico', 'avif'], true)) {
        continue;
    }
    $target = $output.'/images/'.substr($image->getPathname(), strlen($images) + 1);
    if (!is_dir(dirname($target))) {
        mkdir(dirname($target), 0755, true);
    }
    copy($image->getPathname(), $target);
}
foreach (['favicon.ico', 'robots.txt'] as $file) {
    copy(public_path($file), $output.'/'.$file);
}
file_put_contents($output.'/vercel.json', json_encode([
    '$schema' => 'https://openapi.vercel.sh/vercel.json',
    'framework' => null,
    'buildCommand' => null,
    'installCommand' => null,
    'cleanUrls' => true,
    'trailingSlash' => false,
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)."\n");
echo "Static site ready in deploy-static/\n";
