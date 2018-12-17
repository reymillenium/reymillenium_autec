<?php
    
    namespace Tests\Feature\Admin;
    
    use Autec\User;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    
    class AdminEventsPageTest extends TestCase
    {
        
        use RefreshDatabase;
        
        /**
         * Que los administradores puedan visitar el panel de eventos (admin_events_page)
         *
         * @test
         */
        public function admins_can_visit_the_admin_events_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this->actingAs($this->createAdmin())
                ->get(route('admin.admin_events_page'))
                ->assertStatus(200)
                ->assertSee('Admin Events Panel');
            
        }
        
        /**
         * Que los usuarios no admin (operators) no puedan acceder al panel de eventos (admin_events_page)
         *
         * @test
         */
        public function non_admin_users_cannot_visit_the_admin_events_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this->actingAs($this->createOperator())
                ->get(route('admin.admin_events_page'))
                // Indica que la ruta está prohibida (error 403). La ruta puede existir, uno está conectado pero no tiene permiso para verla
                ->assertStatus(403);
        }
        
        /**
         * Que los invitados (guests) no puedan visitar el panel de eventos (admin_events_page)
         *
         * @test
         */
        public function guests_cannot_visit_the_admin_events_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this->get(route('admin.admin_events_page'))
                // Redirección temporal (error 302) a la pantalla de inicio de sesión (login)
                ->assertStatus(302)
                ->assertRedirect('login');
            
        }
    }
