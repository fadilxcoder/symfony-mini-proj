# Data Fixtures

- Install `composer require --dev orm-fixtures`
- DataFixtures folder will appear
- Create your class `PricingBlockFixtures`
- Use command to RUN `php bin/console doctrine:fixtures:load --group=pricing-block --append`
- If `--append` is omitted, 'It will clear DB'


