import './bootstrap';  // Si tienes configuraciones previas de Bootstrap o jQuery
import { createApp } from 'vue';  // Crear la aplicación Vue
import NoteaApp from './components/NoteApp.vue';  // Importa el componente NoteaApp (ruta relativa)

createApp(NoteaApp).mount('#app');  // Montar la aplicación Vue en el elemento con id="app"
