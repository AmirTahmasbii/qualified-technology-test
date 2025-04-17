<script setup>
import { ref } from 'vue'
import Editor from '@tinymce/tinymce-vue'
import { useForm } from '@inertiajs/vue3'

const fileInput = ref(null)

const form = useForm({
    title: '',
    description: '',
    image: null,
})

const selectFile = () => {
    fileInput.value?.click()
}

const handleImageUpload = (e) => {
    form.image = e.target.files[0]
}

const submit = () => {
    form.post('/items', {
        forceFormData: true,
    })
}
</script>

<template>
    <main id="sample">
        <div class="p-6 max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Create Item</h1>

            <form @submit.prevent="submit" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Title</label>
                    <input type="text" v-model="form.title" class="form-control w-full border rounded px-3 py-2" />
                    <div v-if="form.errors.title" class="text-red-500 text-sm">{{ form.errors.title }}</div>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Image</label>

                    <input ref="fileInput" type="file" accept="image/*" class="hidden" @change="handleImageUpload" />

                    <button type="button" class="bg-[#1e293b] text-white px-4 py-2 rounded hover:opacity-90"
                        @click="selectFile">
                        Select Image
                    </button>

                    <div v-if="form.image" class="mt-2 text-sm text-gray-600">
                        Selected: {{ form.image.name }}
                    </div>

                    <div v-if="form.errors.image" class="text-red-500 text-sm">{{ form.errors.image }}</div>
                </div>


                <div class="mb-4">
                    <label class="block font-semibold mb-1">Description</label>
                    <TinyEditor v-model="form.description" />
                    <div v-if="form.errors.description" class="text-red-500 text-sm">{{ form.errors.description }}</div>
                </div>
                <Editor api-key="xwyyahigpojp50dvtjj78bdw5l6mopr323pu24yof0iwfeg4" :init="{
                    toolbar_mode: 'sliding',
                    plugins: [
                        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                    ],
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    mergetags_list: [
                        { value: 'First.Name', title: 'First Name' },
                        { value: 'Email', title: 'Email' },
                    ],
                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
                }" :modelValue="form.description" @update:modelValue="form.description = $event"
                    initial-value="Description" />

                <button type="submit" class="mt-6 bg-[#1e293b] text-white border px-4 py-2 rounded hover:opacity-90">
                    Save Item
                </button>
            </form>
        </div>

    </main>
</template>