<script setup>

import { ref, computed } from 'vue';
import moment from 'moment';
moment.updateLocale('en', {
    week: {
        dow: 1,
        doy: 4,
    }
});
const currentMonth = ref(moment());
var currentView = ref('month');
var selectedDay = ref(null);
var selectedWeek = ref(null);
const eventStart = ref(null);
const eventEnd = ref(null);

const dayHeaders = ["Monday", "Tuesday", "Wednesday", "Thursday", "Firday", "Saturday", "Sunday"];

const daysInMonth = computed(() => {

    const start = currentMonth.value.clone().startOf('month').startOf('week');
    const end = currentMonth.value.clone().endOf('month').endOf('week');
    const days = [];
    let day = start.clone();

    while (day.isBefore(end)) {
        days.push(day.clone());
        day.add(1, 'day');
    }
    return days;
});

const daysInWeek = computed(() => {
    const start = selectedDay.value.clone().startOf('week');
    const days = [];
    let day = start.clone();

    for (let i = 0; i < 7; i++) {
        days.push(day.clone());
        day.add(1, 'day');
    }

    return days;
});

const hoursInDay = computed(() => {
    return Array.from({ length: 24 }, (_, i) => `${String(i).padStart(2, '0')}:00`);
});

const currentViewTitle = computed(() => {
    if (currentView.value === 'month') return currentMonth.value.format('MMMM YYYY');
    if (currentView.value === 'week') return `${daysInWeek.value[0].format('MMM D')} - ${daysInWeek.value[6].format('MMM D, YYYY')}`;
    if (currentView.value === 'day') return selectedDay.value.format('MMMM D, YYYY');
});


const goToPrevious = () => {
    if (currentView.value === 'month') {
        currentMonth.value = currentMonth.value.clone().subtract(1, 'month');
    } else if (currentView.value === 'week') {
        selectedDay.value = selectedDay.value.clone().subtract(1, 'week');
        currentMonth.value = selectedDay.value.clone();
    } else if (currentView.value === 'day') {
        selectedDay.value.subtract(1, 'day');
    }
};

const goToNext = () => {
    if (currentView.value === 'month') {
        currentMonth.value = currentMonth.value.clone().add(1, 'month');
    } else if (currentView.value === 'week') {
        selectedDay.value = selectedDay.value.clone().add(1, 'week');
        currentMonth.value = selectedDay.value.clone();
    } else if (currentView.value === 'day') {
        selectedDay.value.add(1, 'day');
    }
};

const goToDayView = (day) => {
    currentView.value = 'day';
    selectedDay.value = day;
};

const goToWeekView = (day) => {
    if (!day.isSame(currentMonth.value, 'month')) {
        currentMonth.value = day.clone();
    } else {
        selectedDay.value = day;
        currentView.value = 'week';
    }
};

const goToMonthView = () => {
    currentView.value = 'month';
};

const goUpCalendar = () => {
    switch (currentView.value) {
        case 'week':
            console.log(currentMonth.value)
            goToMonthView()
            break;
        case 'day':
            goToWeekView()
            break;
        default:
            break;
    }
};

</script>

<template>
    <div class="mb-7">
        <h2 class="text-lg mb-4">Select when event is taking place</h2>
        <div class="flex justify-around mb-4 col-span-7 space-x-5">
            <button @click="goToPrevious"><i class="fa-solid fa-angles-left"></i></button>
            <button @click="goUpCalendar" class="">{{ currentViewTitle }}</button>
            <button @click="goToNext"><i class="fa-solid fa-angles-right"></i></button>
        </div>

        <div v-if="currentView === 'month'" class="grid grid-cols-7 place-items-center">
            <div class="text-md w-fit" v-for="header in dayHeaders">
                {{ header }}
            </div>
            <button v-for="(day, index) in daysInMonth" :key="index"
                :class="['p-2 rounded-lg w-11  mb-1 text-center', day.isSame(currentMonth, 'month') ? 'hover:shadow-lg hover:dark:bg-orange-700 hover:bg-orange-500' : 'text-zinc-400 dark:text-black']"
                @click="day.isSame(currentMonth, 'month') ? goToWeekView(day) : ''">
                {{ day.format('D') }}
            </button>
        </div>

        <div v-else-if="currentView === 'week'" class="grid grid-cols-7 place-items-center">
            <div v-for="day in daysInWeek" :key="day.format('YYYY-MM-DD')" class="p-2 border w-full">
                <h3 class="text-center mb-4">{{ day.format('ddd, MMM D') }}</h3>
                <div class="relative">
                    <div v-for="hour in hoursInDay" :key="hour" class="h-8 border-b text-xs text-white">
                        {{ hour }}
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="currentView === 'day'">
            Day
        </div>
    </div>
</template>
