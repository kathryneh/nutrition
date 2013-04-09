// \afs\cs.unc.edu\project\courses\comp523-s13\public_html\nutrition\authenticatetest.php

namespace authenticate;

use \afs\cs.unc.edu\project\courses\comp523-s13\public_html\nutrition\authenticate;

class authenticatetest extends \PHPUnit_Framework_TestCase
{
        public function testCreateUser()
        {
                $authenticate = new Authenticate();
                $this -> assertEquals('test@gmail.com', $authenticate->createUser("test@gmail.com", "password", 0));
        }

        public function 
}