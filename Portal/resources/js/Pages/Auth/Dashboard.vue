<script setup>
import { useForm } from '@inertiajs/vue3'
import PageFloatContainer from '../Components/PageFloatContainer.vue';
import ConfirmButton from '../Components/ConfirmButton.vue';
const form = useForm({
    pfp: null,
    preview: null,
})

const changePfp = (event) => {
    form.pfp = event.target.files[0]
    form.preview = URL.createObjectURL(event.target.files[0])
}

const submit = () => {
    form.post(route("changePfp"), {
        onError: () => form.reset("pfp")
    })
}

defineProps({
    needVerification: String,
    status: String,
})
</script>

<template>

    <Head>
        <title> | Panel użytkownika</title>
    </Head>

    <PageFloatContainer>
        <div class="flex flex-col space-y-2">
            <div>
                <h1 class="text-xl font-bold">Cześć {{ $page.props.auth.user.name }}</h1>
            </div>
            <form @submit.prevent="submit" class="flex flex-col space-y-2 max-w-xs">
                <div class="flex flex-col">
                    <h1 class="text-lg font-semibold">Szczegóły profilu</h1>
                    <div class="ms-4 mt-1">
                        <p>Zdjęcie profilowe</p>
                        <div class="cursor-pointer w-32 h-32 border border-orange-800 rounded-full overflow-hidden">
                            <div class="flex items-center justify-center h-full text-gray-500">
                                <label for="pfp" class="h-full w-full"><img class="h-full w-full"
                                        :src="form.preview ? (form.preview) : ('/storage/' + $page.props.auth.user.profilepic)"></label>
                            </div>
                            <input type="file" id="pfp" name="pfp" accept="image/*" @input="changePfp" hidden>
                            <p>{{ form.errors.pfp }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <ConfirmButton>Zatwierdź zmiany</ConfirmButton>
                </div>
            </form>
        </div>
    </PageFloatContainer>
</template>
