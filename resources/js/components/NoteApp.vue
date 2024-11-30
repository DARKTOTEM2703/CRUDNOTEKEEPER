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
  export default {
    data() {
      return {
        notes: [],
        newNote: {
          titulo: '',
          autor: '',
          descripcion: '',
          fecha: ''
        }
      };
    },
    methods: {
      // Cargar notas desde el servidor
      fetchNotes() {
        axios.get('/api/notes').then(response => {
          this.notes = response.data;
        });
      },
  
      // Crear nueva nota
      createNote() {
        axios.post('/api/notes', this.newNote).then(response => {
          this.fetchNotes();  // Recargar las notas después de crear una nueva
          this.newNote = { titulo: '', autor: '', descripcion: '', fecha: '' }; // Limpiar formulario
        });
      },
  
      // Editar nota
      editNote(note) {
        // Lógica para editar (opcionalmente podrías abrir un formulario de edición)
        alert('Editar nota: ' + note.id);
      },
  
      // Eliminar nota
      deleteNote(id) {
        axios.delete(`/api/notes/${id}`).then(response => {
          this.fetchNotes();  // Recargar las notas después de eliminar
        });
      }
    },
    created() {
      this.fetchNotes();  // Cargar notas cuando el componente se monte
    }
  };
  </script>
  