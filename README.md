# Setup

## Symfony 6.3 project setup
```
# IDE
PhpStorm

# Install dependencies
composer install

# Create database
php bin/console doctrine:database:create
symfony make:migration
symfony doctrine:migrations:migrate

# Run server
php -S localhost:8000 -t public/

``` 

## Vue 3 project setup

```
# yarn
yarn

# npm
npm install

# pnpm
pnpm install

# pnpm
bun install
```

### Compiles and hot-reloads for development

```
# yarn
yarn dev

# npm
npm run dev

# pnpm
pnpm dev

# bun
bun run dev
```

### Compiles and minifies for production

```
# yarn
yarn build

# npm
npm run build

# pnpm
pnpm build

# bun
bun run build
```

### Lints and fixes files

```
# yarn
yarn lint

# npm
npm run lint

# pnpm
pnpm lint

# bun
bun run lint
```

### Customize configuration

See [Configuration Reference](https://vitejs.dev/config/).
