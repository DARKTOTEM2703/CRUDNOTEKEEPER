<template>
  <div>
      <h1>NoteKeeper</h1>
      
      <!-- Formulario de nueva nota -->
      <form @submit.prevent="createNote">
          <div class="form-group">
              <label for="titulo">Título</label>
              <input v-model="newNote.titulo" type="text" class="form-control" id="titulo" required />
          </div>
          <div class="form-group">
              <label for="autor">Autor</label>
              <input v-model="newNote.autor" type="text" class="form-control" id="autor" required />
          </div>
          <div class="form-group">
              <label for="descripcion">Descripción</label>
              <textarea v-model="newNote.descripcion" class="form-control" id="descripcion" rows="4" required></textarea>
          </div>
          <div class="form-group">
              <label for="fecha">Fecha</label>
              <input v-model="newNote.fecha" type="date" class="form-control" id="fecha" required />
          </div>
          <button type="submit" class="btn btn-primary">Crear Nota</button>
      </form>

      <hr />

      <!-- Listado de notas -->
      <div v-if="notes.length">
          <h2>Notas</h2>
          <table class="table">
              <thead>
                  <tr>
                      <th>Título</th>
                      <th>Autor</th>
                      <th>Descripción</th>
                      <th>Fecha</th>
                      <th>Acciones</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="note in notes" :key="note.id">
                      <td>{{ note.titulo }}</td>
                      <td>{{ note.autor }}</td>
                      <td>{{ note.descripcion }}</td>
                      <td>{{ note.fecha }}</td>
                      <td>
                          <button @click="editNote(note)" class="btn btn-warning">Editar</button>
                          <button @click="deleteNote(note.id)" class="btn btn-danger">Eliminar</button>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</template>

<script>
import axios from 'axios';

// Asegúrate de que las solicitudes de Axios apunten al backend de Laravel
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';

// Si deseas, puedes configurar los encabezados de CORS manualmente si es necesario
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['Content-Type'] = 'application/json';

export default {
  data() {
      return {
          notes: [],
          newNote: {
              titulo: '',
              autor: '',
              descripcion: '',
              fecha: ''
          },
      };
  },
  methods: {
      // Cargar notas desde el servidor
      fetchNotes() {
          axios.get('/api/notes')
          axios.get('http://127.0.0.1:8000/api/notes')
              .then(response => {
                  this.notes = response.data;
              })
              .catch(error => {
                  console.error('Error al cargar las notas:', error);
              });
      },

      // Crear nueva nota
      createNote() {
          axios.post('/api/notes', this.newNote)
              .then(response => {
                  this.notes.push(response.data);  // Agregar la nueva nota al array
                  this.newNote = { titulo: '', autor: '', descripcion: '', fecha: '' }; // Limpiar formulario
              })
              .catch(error => {
                  console.error('Error al crear la nota:', error);
              });
      },

      // Editar nota (opcional)
      editNote(note) {
          alert('Editar nota: ' + note.id);
          // Implementa la lógica para editar
      },

      // Eliminar nota
      deleteNote(id) {
          axios.delete(`/api/notes/${id}`)
              .then(response => {
                  this.notes = this.notes.filter(note => note.id !== id);  // Eliminar la nota de la lista
              })
              .catch(error => {
                  console.error('Error al eliminar la nota:', error);
              });
      }
  },
  created() {
      this.fetchNotes();  // Cargar notas cuando el componente se monte
  }
};
</script>
