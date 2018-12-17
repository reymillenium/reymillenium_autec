<?php
    
    namespace Tests\Unit;
    
    use Autec\User;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    
    class UserTest extends TestCase
    {
        
        use RefreshDatabase;
        
        /**
         * Quiero comprobar que un usuario puede ser un administrador
         *
         * @test
         */
        public function a_user_can_be_and_admin()
        {
            // Permite obtener más detalles al correr las pruebas
            $this->withoutExceptionHandling();
            
            // Creamos un user, que no sea administrador
            $user = factory(User::class)->create([
                'kind' => 'operator'
            ]);
            
            // Recargo las propiedades y atributos de este modelo usando refresh (¿?)
            $user->refresh();
            
            $this->assertFalse($user->isAdmin());
            
            $user->kind = 'administrator';
            $user->save();
            
            $this->assertTrue($user->isAdmin());
            
            
        }
        
    }
