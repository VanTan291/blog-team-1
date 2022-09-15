# clone sourcecode
git clone git@github.com:VanTan291/blog-team-1.git

# set up project
composer install
npm install

# copy file .env
cp .env.example .env

# create key project
php artisan key:generate

# run database
php artisan migrate
php artisan db:seed

# run project
php artisan serve
