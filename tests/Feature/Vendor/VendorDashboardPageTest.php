<?php
    
    namespace Tests\Feature\Admin;
    
    use Autec\User;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    
    class VendorDashboardPageTest extends TestCase
    {
        
        use RefreshDatabase;
        
        /**
         * Que los vendedores puedan visitar el Panel Administrativo del Vendedor (vendor_dashboard_page)
         *
         * @test
         */
        public function vendors_can_visit_the_vendor_dashboard_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $vendor = factory(User::class)->create([
                'kind' => 'vendor'
            ]);
            
            $this->actingAs($vendor)
                ->get(route('vendor.vendor_dashboard_page'))
                ->assertStatus(200)
                ->assertSee('Vendor Dashboard Panel');
            
        }
        
        /**
         * Que los usuarios no client (operators, admins, clients) no puedan acceder al panel administrativo del Vendedor (vendor_dashboard_page)
         *
         * @test
         */
        public function non_vendor_users_cannot_visit_the_vendor_dashboard_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            // Operadores
            $operator = factory(User::class)->create([
                'kind' => 'operator'
            ]);
            
            $this->actingAs($operator)
                ->get(route('vendor.vendor_dashboard_page'))
                // Indica que la ruta está prohibida. La ruta puede existir, uno está conectado pero no tiene permiso para verla
                ->assertStatus(403);
            
            // Administradores
            $this->actingAs($this->createAdmin())
                ->get(route('vendor.vendor_dashboard_page'))
                // Indica que la ruta está prohibida. La ruta puede existir, uno está conectado pero no tiene permiso para verla
                ->assertStatus(403);
            
            // Clientes
            $client = factory(User::class)->create([
                'kind' => 'client'
            ]);
            
            $this->actingAs($client)
                ->get(route('vendor.vendor_dashboard_page'))
                // Indica que la ruta está prohibida. La ruta puede existir, uno está conectado pero no tiene permiso para verla
                ->assertStatus(403);
        }
        
        /**
         * Que los invitados (guests, no registrados) no puedan visitar el panel administrativo del Vendedor (vendor_dashboard_page)
         *
         * @test
         */
        public function guests_cannot_visit_the_vendor_dashboard_page()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            $this->get(route('vendor.vendor_dashboard_page'))
                // Redirección temporal a la pantalla de inicio de sesión (login)
                ->assertStatus(302)
                ->assertRedirect('login');
            
        }
    }
