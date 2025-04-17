<template>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Item List</h1>
      <Link href="/items/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + New Item
      </Link>
      <div class="mt-6 overflow-x-auto">
        <table class="min-w-full border border-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="text-left px-4 py-2 border-b">#</th>
              <th class="text-left px-4 py-2 border-b">Title</th>
              <th class="text-left px-4 py-2 border-b">Description</th>
              <th class="text-left px-4 py-2 border-b">Image</th>
              <th class="text-left px-4 py-2 border-b">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item.id" class="hover:bg-gray-50">
              <td class="px-4 py-2 border-b">{{ item.id }}</td>
              <td class="px-4 py-2 border-b">{{ item.title }}</td>
              <td class="px-4 py-2 border-b">{{ truncate(item.description) }}</td>
              <td class="px-4 py-2 border-b">
                <img v-if="item.image" :src="'/storage/images/' + item.image" class="w-16 h-16 object-cover rounded" />
                <span v-else class="text-sm text-gray-400 italic">No image</span>
              </td>
              <td class="px-4 py-2 border-b">
                <Link :href="`/items/${item.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
                <button @click="deleteItem(item.id)" class="text-red-600 hover:underline">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <div v-if="loading" class="text-center text-gray-500 py-4">Loading more...</div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    data() {
      return {
        items: [],
        nextPageUrl: '/items?page=1',
        loading: false,
      }
    },
    mounted() {
      this.loadItems()
      window.addEventListener("scroll", this.handleScroll)
    },
    unmounted() {
      window.removeEventListener("scroll", this.handleScroll)
    },
    methods: {
      async loadItems() {
        if (!this.nextPageUrl || this.loading) return
        this.loading = true
        try {
          const res = await axios.get(this.nextPageUrl)
          this.items = [...this.items, ...res.data.data]
          this.nextPageUrl = res.data.next_page_url
        } catch (err) {
          console.error('Failed to load items:', err)
        }
        this.loading = false
      },
      handleScroll() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
          this.loadItems()
        }
      },
      truncate(text, length = 80) {
        return text.length > length ? text.substring(0, length) + "..." : text
      },
    }
  }
  </script>
  