import fs from 'node:fs';
import assert from 'node:assert/strict';

for (const page of ['index', 'history', 'places', 'tiger-legend']) {
    const html = fs.readFileSync(`deploy-static/${page}.html`, 'utf8');
    assert(!/localhost|static-export\.invalid/.test(html), `${page}: local URL`);
    for (const match of html.matchAll(/(?:src|href)="(\/[^"#]*)/g)) {
        const path = decodeURI(match[1]);
        assert(fs.existsSync(`deploy-static${path}`) || fs.existsSync(`deploy-static${path}.html`), `${page}: missing ${path}`);
    }
    const active = [...html.matchAll(/<a href="([^"]*)"\s+aria-current="page"/g)];
    assert.equal(active.length, 1, `${page}: active navigation`);
    assert.equal(active[0][1], page === 'index' ? '/' : `/${page}`);
    console.log(`${page}: internal links, images and navigation passed`);
}
const places = fs.readFileSync('deploy-static/places.html', 'utf8');
assert(places.includes('href="https://vt.tiktok.com/ZSbMXHQUW/"'), 'TikTok link missing');
for (const file of fs.readdirSync('deploy-static', { recursive: true })) {
    assert(!/(?:\.php|\.env|\.sqlite|\.log)$/.test(file), `Unexpected private file: ${file}`);
}
console.log('TikTok link and public-file checks passed');
