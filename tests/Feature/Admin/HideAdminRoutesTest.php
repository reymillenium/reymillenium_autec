<?php
    
    namespace Tests\Feature\Admin;
    
    use Autec\User;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    
    class HideAdminRoutesTest extends TestCase
    {
        
        /**
         * Queremos comprobar que los usuarios anónimos no puedan descubrir las urls del administrador (peticiones GET)
         *
         * @test
         */
        public function it_does_not_allow_guests_to_discover_admin_urls_using_get()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            // Llamamos a una url inválida
            $this->get('invalid_url_page')
                // Se muestra un código 302 (redirección encontrada) en lugar de un 404 para todos los usuarios no conectados, y así esconder las paginas de mi app web
                ->assertStatus(302)
                // El guest es redireccionado a la pagina de login sin importar si existe o no la página a la que intenta acceder
                ->assertRedirect('login');
            
        }
        
        // /**
        //  * Queremos comprobar que los usuarios anónimos no puedan descubrir las urls del administrador (peticiones POST)
        //  *
        //  * @test
        //  */
        // public function it_does_not_allow_guests_to_discover_admin_urls_using_post()
        // {
        //     // Permite obtener más detalles al correr las pruebas
        //     // $this->withoutExceptionHandling();
        //
        //     // Llamamos a una url inválida
        //     // $this->post('invalid_url')
        //     // $this->post('create_event')
        //     $this->post('{any}')->where('any', '.*')
        //         // Se muestra un código 302 (redirección encontrada) en lugar de un 404 para todos los usuarios no conectados, y así esconder las paginas de mi app web
        //         ->assertStatus(302)
        //         // El guest es redireccionado a la pagina de login sin importar si existe o no la página a la que intenta acceder
        //         ->assertRedirect('login');
        //
        // }
        
        /**
         * Comprobamos que se muestra un error 404 cuando un administrador válido visite una url del admimistrador que no sea válida
         *
         * @test
         */
        public function it_displays_404s_when_admins_visit_invalid_urls()
        {
            // Permite obtener más detalles al correr las pruebas
            // $this->withoutExceptionHandling();
            
            // Creamos un administrador y actuamos como él
            $this->actingAs($this->createAdmin())
                // Llamamos a una url inválida
                ->get('invalid_url_page')
                // Se debe mostrar el error 404, pero solo a los administradores conectados como tal
                ->assertStatus(404);
            
        }
        
        
    }
