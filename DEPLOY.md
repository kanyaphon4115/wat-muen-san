# Deploy to Vercel

The current site has four public pages with browser-side interactions. Laravel
renders these pages locally; Vercel serves the exported HTML and images.
PHP, a database, and Laravel secrets are not required on Vercel.

From the Laravel project directory, run:

```powershell
php scripts/export-static.php
cd deploy-static
npx vercel login
npx vercel link
npx vercel deploy --prod
```

Choose a new project named `wat-muen-san` when linking. The export includes a
Vercel configuration with clean URLs for `/history`, `/places`, and
`/tiger-legend`. Upload only `deploy-static`, never the Laravel project root.

After editing Blade templates, CSS, JavaScript, or images, run the export again
and deploy the same directory. Edits made only in the separate XAMPP copy must
first be copied back into this project.

This deployment does not run future Laravel backend features (logins, form
submissions, database writes). Those would need a PHP hosting/runtime setup.
