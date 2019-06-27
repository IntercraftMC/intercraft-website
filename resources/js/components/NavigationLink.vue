<template>
    <li class="nav-item">
        <a v-bind:href="href" class="nav-link">
            <slot></slot>
        </a>
    </li>
</template>
<script>
export default {
    props: [
        "href"
    ]
}
</script>

