php bin/console doctrine:migrations:migrate
PASS="$(heroku config:get JWT_PASSPHRASE)"
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -pass $PASS -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -passin $PASS -out config/jwt/public.pem -pubout