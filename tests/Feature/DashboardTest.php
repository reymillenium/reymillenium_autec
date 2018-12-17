<?php
    
    namespace Tests\Feature;
    
    use Autec\User;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    
    class DashboardTest extends TestCase
    {
    
        use RefreshDatabase;
    
        
        /**
         * Probamos que muestra la página de Dashboard a los usuarios autenticados (que hayan iniciado sesión)
         *
         * @test
         */
        public function it_shows_the_dashboard_page_authenticated_users()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            // Creamos un User
            $user = factory(User::class)->create();
            
            $this
                // Le indico a Laravel que quiero actuar como el User
                ->actingAs($user)
                // Me dirijo a la página del Home
                ->get('home')
                // OK
                // ->get(route('home_page'))
                // Verifico que se pueda observar el título 'Dashboard'
                ->assertSee('Dashboard')
                // Y que el status de esta página sea 200 (que la página ha cargado con éxito)
                ->assertStatus(200);
            
            
        }
        
        /**
         * Probamos que no se muestre la página de Dashboard a los usuarios que no estén conectados
         *
         * @test
         */
        public function it_redirects_guest_to_login_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this
                // Le indico a Laravel que quiero actuar como el User
                // Me dirijo a la página del Home directamente
                ->get('home')
                // Verifico que el status de esta página sea 302 (que la página )
                ->assertStatus(302)
                // Verifico que se redireccione hacia login
                ->assertRedirect('login');
        }
        
    }
