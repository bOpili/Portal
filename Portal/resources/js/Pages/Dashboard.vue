<script setup>
import { useForm } from '@inertiajs/vue3'
const form = useForm({
    pfp: null,
    preview: null,
})

const changePfp = (event) => {
    //console.log(event.target.files[0])
    form.pfp = event.target.files[0]
    form.preview = URL.createObjectURL(event.target.files[0])
}

const submit = () => {
    form.post(route("changePfp"), {
        onError: () => form.reset("pfp")
    })
}
</script>

<template>
    <div class="flex flex-col space-y-2">
        <div>
            <h1 class="text-xl font-bold">Hello {{ $page.props.auth.user.name }}</h1>
        </div>
        <form @submit.prevent="submit" class="flex flex-col space-y-2 max-w-xs">
            <div class="flex flex-col">
                <h1 class="text-lg font-semibold">Profile details</h1>
                <div class="ms-4 mt-4">
                    <div class="cursor-pointer w-32 h-32 border border-orange-800 rounded-full overflow-hidden">
                    <div class="flex items-center justify-center h-full text-gray-500">
                        <label for="pfp" class="h-full w-full"><img class="h-full w-full" :src="form.preview ? (form.preview):($page.props.auth.user.profilepic?('/storage/'+$page.props.auth.user.profilepic):('/storage/ProfilePictures/defaultpfp.jpg'))"></label>
                    </div>
                    <input type="file" id="pfp" name="pfp" accept="image/*" @input="changePfp" hidden>
                    <p>{{ form.errors.pfp }}</p>
                    </div>
                </div>
            </div>
            <div>
                <button
                    class="bg-orange-700 hover:bg-orange-800 text-white py-2 px-4 ring-2 ring-orange-800 rounded mt-4"
                    :disabled="form.processing">Confirm changes</button>
            </div>
        </form>
    </div>
</template>
