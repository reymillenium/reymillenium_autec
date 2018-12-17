<?php
    
    namespace Tests;
    
    // Empleo la sintaxis de PHP 7, que me permite agrupar nombres de espacio
    use Autec\{User, Admin};
    use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
    
    abstract class TestCase extends BaseTestCase
    {
        use CreatesApplication;
        
        
        protected function createAdmin()
        {
            return factory(Admin::class)->create([
                'kind' => 'administrator'
            ]);
        }
        
        protected function createOperator()
        {
            return factory(User::class)->create([
                'kind' => 'operator'
            ]);
        }
        
    }
