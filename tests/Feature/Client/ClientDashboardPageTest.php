<?php
    
    namespace Tests\Feature\Admin;
    
    use Autec\User;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    
    class ClientDashboardPageTest extends TestCase
    {
        
        use RefreshDatabase;
        
        /**
         * Que los clientes puedan visitar el panel administrativo (client_dashboard_page)
         *
         * @test
         */
        public function clients_can_visit_the_client_dashboard_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $client = factory(User::class)->create([
                'kind' => 'client'
            ]);
            
            $this->actingAs($client)
                ->get(route('client.client_dashboard_page'))
                ->assertStatus(200)
                ->assertSee('Client Dashboard Panel');
            
        }
        
        /**
         * Que los usuarios no client (operators, admins, vendors) no puedan acceder al panel administrativo del Cliente (client_dashboard_page)
         *
         * @test
         */
        public function non_client_users_cannot_visit_the_client_dashboard_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            // Operadores
            $operator = factory(User::class)->create([
                'kind' => 'operator'
            ]);
            
            $this->actingAs($operator)
                ->get(route('client.client_dashboard_page'))
                // Indica que la ruta está prohibida. La ruta puede existir, uno está conectado pero no tiene permiso para verla
                ->assertStatus(403);
            
            // Administradores
            $this->actingAs($this->createAdmin())
                ->get(route('client.client_dashboard_page'))
                // Indica que la ruta está prohibida. La ruta puede existir, uno está conectado pero no tiene permiso para verla
                ->assertStatus(403);
            
            // Vendedores
            $vendor = factory(User::class)->create([
                'kind' => 'vendor'
            ]);
            
            $this->actingAs($vendor)
                ->get(route('client.client_dashboard_page'))
                // Indica que la ruta está prohibida. La ruta puede existir, uno está conectado pero no tiene permiso para verla
                ->assertStatus(403);
        }
        
        /**
         * Que los invitados (guests, no registrados) no puedan visitar el panel administrativo del Cliente (client_dashboard_page)
         *
         * @test
         */
        public function guests_cannot_visit_the_client_dashboard_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this->get(route('client.client_dashboard_page'))
                // Redirección temporal a la pantalla de inicio de sesión (login)
                ->assertStatus(302)
                ->assertRedirect('login');
            
        }
    }
