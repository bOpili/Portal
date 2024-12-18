<script setup>

import { ref, computed } from 'vue';
import moment from 'moment';
import throttle from 'lodash.throttle';
moment.updateLocale('en', {
    week: {
        dow: 1,
        doy: 4,
    }
});
const currentMonth = ref(moment());
const today = ref(moment());
var currentView = ref('month');
var selectedDay = ref(null);
const eventStart = ref(null);
const eventEnd = ref(null);
const isDragging = ref(false);

const emit = defineEmits(['selectedEventTimeframe']);

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
    console.log("daysInMonth")
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
    console.log("daysInWeek")
    return days;
});

const hoursInDay = computed(() => {
    const intervals = [];
    for (let i = 0; i < 24; i++) {
        intervals.push(`${String(i).padStart(2, '0')}:00`);
        intervals.push(`${String(i).padStart(2, '0')}:30`);
    }
    console.log("hoursInDay")
    return intervals;
});

const currentViewTitle = computed(() => {
    if (currentView.value === 'month') return currentMonth.value.format('MMMM YYYY');
    if (currentView.value === 'week') return `${daysInWeek.value[0].format('MMM D')} - ${daysInWeek.value[6].format('MMM D, YYYY')}`;
    if (currentView.value === 'day') return selectedDay.value.format('MMMM D, YYYY');
    console.log("currentViewTitle")
});


const goToPrevious = () => {
    if (currentView.value === 'month') {
        currentMonth.value = currentMonth.value.clone().subtract(1, 'month');
    } else if (currentView.value === 'week') {
        selectedDay.value = selectedDay.value.clone().subtract(1, 'week');
        currentMonth.value = selectedDay.value.clone();
    } else if (currentView.value === 'day') {
        selectedDay.value = selectedDay.value.clone().subtract(1, 'day');
    }
    console.log("goToPrevious")
};

const goToNext = () => {
    if (currentView.value === 'month') {
        currentMonth.value = currentMonth.value.clone().add(1, 'month');
    } else if (currentView.value === 'week') {
        selectedDay.value = selectedDay.value.clone().add(1, 'week');
        currentMonth.value = selectedDay.value.clone();
    } else if (currentView.value === 'day') {
        selectedDay.value = selectedDay.value.clone().add(1, 'day');
    }
    console.log("goToNext")
};

const goToDayDbClick = (day) => {
    currentView.value = 'day';
    selectedDay.value = day;
    console.log("goToDayDbClick")
};

const goToWeekView = (day) => {
    if (!day.isSame(currentMonth.value, 'month')) {
        currentMonth.value = day.clone();
    } else {
        selectedDay.value = day;
        currentView.value = 'week';
    }
    console.log("goToWeekView")
};

const goToMonthView = () => {
    currentView.value = 'month';
    console.log("goToMonthView")
};

const goUpCalendar = () => {
    console.log("goUpCalendar")
    switch (currentView.value) {
        case 'week':
            goToMonthView()
            break;
        case 'day':
            goToWeekView(selectedDay.value)
            break;
        default:
            break;
    }
};

const startEvent = (day, hour) => {
    isDragging.value = true;
    eventStart.value = day.clone();
    eventStart.value = day.clone().hour(parseInt(hour.substring(0, 2))).minutes(parseInt(hour.substring(3, 5)));
    eventEnd.value = eventStart.value;
    console.log("startEvent")
};

const dragEvent = throttle((day, hour) => {
    if (isDragging.value) {
        eventEnd.value = day.clone().hour(parseInt(hour.substring(0, 2))).minutes(parseInt(hour.substring(3, 5)));
        console.log(eventEnd.value)
    }
    console.log("dragEvent")
},100);

const endEvent = () => {
    if (isDragging.value && eventStart.value && eventEnd.value) {
        isDragging.value = false;
        const event = {
            start: eventStart.value.format('YYYY-MM-DD HH:mm'),
            end: eventEnd.value.format('YYYY-MM-DD HH:mm'),
        };
        emit('selectedEventTimeframe', event);
    }
    console.log("endEvent")
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
                :class="['p-2 rounded-lg w-11  mb-1 text-center', day.isSame(currentMonth, 'month') ? 'hover:shadow-lg hover:dark:bg-orange-700 hover:bg-orange-500' : 'text-zinc-400 dark:text-black', day.isSame(today, 'day') ? 'font-bold ring-1 ring-orange-500 bg-orange-500 bg-opacity-25' : '']"
                @click="day.isSame(currentMonth, 'month') ? goToWeekView(day) : ''">
                <span v-if="day.isSame(currentMonth, 'month')">{{ day.format('D') }}</span>
            </button>
        </div>

        <div v-else-if="currentView === 'week'" class="grid grid-cols-7 place-items-center">
            <div v-for="day in daysInWeek" :key="day.format('YYYY-MM-DD')"
                :class="['p-2 w-full', day.isSame(today, 'day') ? 'bg-orange-500 bg-opacity-25' : '']">
                <h3 class="text-center mb-4">{{ day.format('ddd, MMM D') }}</h3>
                <div @dblclick="goToDayDbClick(day)">
                    <div v-for="hour in hoursInDay" :key="hour" @mousedown="startEvent(day, hour)"
                    @mousemove="isDragging ? dragEvent(day, hour) : ''" @mouseup="endEvent"
                    :class="['h-9 border-b border-b-orange-600 text-xs select-none',
                        eventStart ? (parseInt(hour.substring(0, 2)) >= eventStart.hour() && parseInt(hour.substring(0, 2)) <= eventEnd.hour() && parseInt(hour.substring(3, 5)) <= eventEnd.minutes() && eventStart.isSame(day, 'day') ? 'bg-orange-700 bg-opacity-40' : '') : '',
                        selectedDay.isSame(today, 'day') ? (parseInt(hour.substring(0, 2)) == today.get('hour') && parseInt(hour.substring(3, 5)) <= today.get('minutes') ? 'border-t-2 border-t-red-700' : '') : '']">
                        {{ hour }}
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="currentView === 'day'">
            <div>
                <div v-for="hour in hoursInDay" :key="hour" @mousedown="startEvent(selectedDay, hour)"
                    @mousemove="isDragging ? dragEvent(selectedDay, hour) : ''" @mouseup="endEvent"
                    :class="['h-9 border-b border-b-orange-600 text-xs select-none',
                        eventStart ? (parseInt(hour.substring(0, 2)) >= eventStart.hour() && parseInt(hour.substring(0, 2)) <= eventEnd.hour() && eventStart.isSame(selectedDay, 'day') ? 'bg-orange-700 bg-opacity-40' : '') : '',
                        selectedDay.isSame(today, 'day') ? (parseInt(hour.substring(0, 2)) == today.get('hour') && parseInt(hour.substring(3, 5)) <= today.minutes() ? 'border-t-4 border-t-red-700' : '') : '']">
                    {{ hour }}
                </div>
            </div>
        </div>
    </div>
</template>
