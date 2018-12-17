<?php
    
    namespace Tests\Feature\Admin;
    
    use Autec\User;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    
    class AdminNewsPageTest extends TestCase
    {
        
        use RefreshDatabase;
        
        /**
         * Que los administradores puedan visitar el panel de noticias (admin_news_page)
         *
         * @test
         */
        public function admins_can_visit_the_admin_news_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this->actingAs($this->createAdmin())
                ->get(route('admin.admin_news_page'))
                ->assertStatus(200)
                ->assertSee('Admin News Panel');
            
        }
        
        /**
         * Que los usuarios no admin (operators) no puedan acceder al panel de noticias (admin_news_page)
         *
         * @test
         */
        public function non_admin_users_cannot_visit_the_admin_news_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this->actingAs($this->createOperator())
                ->get(route('admin.admin_news_page'))
                // Indica que la ruta está prohibida. La ruta puede existir y uno está conectado, pero no tiene permiso para verla
                ->assertStatus(403);
        }
        
        /**
         * Que los invitados (guests) no puedan visitar el panel de noticias (admin_news_page)
         *
         * @test
         */
        public function guests_cannot_visit_the_admin_news_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this->get(route('admin.admin_news_page'))
                // Redirección temporal a la pantalla de inicio de sesión (login)
                ->assertStatus(302)
                ->assertRedirect('login');
            
        }
    }
