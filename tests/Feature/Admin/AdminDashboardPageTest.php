<?php
    
    namespace Tests\Feature\Admin;
    
    use Autec\User;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    
    class AdminDashboardPageTest extends TestCase
    {
        
        use RefreshDatabase;
        
        /**
         * Que los administradores puedan visitar el panel administrativo (admin_dashboard_page)
         *
         * @test
         */
        public function admins_can_visit_the_admin_dashboard_page()
        {
            // Permite obtener más detalles al correr las pruebas
            $this->withoutExceptionHandling();
            
            $this->actingAs($this->createAdmin(), 'admin')
                ->get(route('admin.admin_dashboard_page'))
                ->assertStatus(200)
                ->assertSee('Admin Dashboard Panel');
            
        }
        
        /**
         * Que los usuarios no admin (operators) no puedan acceder al panel administrativo (admin_dashboard_page)
         *
         * @test
         */
        public function non_admin_users_cannot_visit_the_admin_dashboard_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this->actingAs($this->createOperator())
                ->get(route('admin.admin_dashboard_page'))
                // Indica que la ruta está prohibida. La ruta puede existir, uno está conectado pero no tiene permiso para verla
                ->assertStatus(403);
        }
        
        /**
         * Que los invitados (guests) no puedan visitar el panel administrativo (admin_dashboard_page)
         *
         * @test
         */
        public function guests_cannot_visit_the_admin_dashboard_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this->get(route('admin.admin_dashboard_page'))
                // Redirección temporal a la pantalla de inicio de sesión (login)
                ->assertStatus(302)
                ->assertRedirect('login');
            
        }
        
    }

