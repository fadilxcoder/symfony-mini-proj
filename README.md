- **master** branch : files to deploy on PROD (heroku)
- **develop** branch : *feature* branches to merge with in DEV environment

[ (feature/01, feature/02, .....) ] -> [ develop ] -> [ master ]

# Deploying on HEROKU

- create file : `Profile`
- change configuration in .env : `APP_ENV=prod`
- change configuration in *config/packages/prod/monolog.yaml* : `nested > path: "php://stderr"`
- **Heroku** -> In CMD : `heroku config:set NPM_CONFIG_PRODUCTION=false YARN_PRODUCTION=false NODE_MODULES_CACHE=false`
- **Heroku** -> In CMD : `heroku buildpacks:add --index 1 heroku/nodejs` tell Heroku that our project is PHP but NodeJS too
- Comment `yarn.lock` i.e : `yarn.lock` to `~yarn.lock` to avoid conflict when installing node packages.
- **Heroku** -> In CMD : `heroku logs --tail` to see logs of heroku process
- **Git** -> In CMD : `git add .`
- **Git** -> In CMD : `git commit -m 'your commit message goes here'`
- **Git** -> In CMD : `git push heroku master`
- **Heroku** -> In CMD : `heroku run bash -a gfx-your-app-name` connection to heroku terminal