<?php 
    namespace App\Security;
    use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
    use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Security\Core\Exception\AuthenticationException;

    class TokenAuthenticator extends AbstractAuthenticator {
        
        public function supports(Request $request): ?bool {
            return $request->headers->has("X-AUTH-TOKEN");
        }

        public function authenticate(Request $request): passport {
            $token = $request->headers->get('X_AUTH-TOKEN');
            if(null === $token) {
                throw new CustomUserMessageAuthentication('No API token provided');
            }

            return new SelfValidatingPassport(new UserBudge($token));
        }

        public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response {
            return null;
        }

        public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response {
            throw new AuthenticationExeption($exception->getMessage());
        }


 
    }
?>