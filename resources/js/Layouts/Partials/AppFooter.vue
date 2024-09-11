<script setup></script>

<template>
    <footer class="text-zinc-500">
        <div class="text-center font-bold py-6">
            <p>{{ new Date().getFullYear() }} - {{ $page.props.appName }}</p>
        </div>
    </footer>
</template>
