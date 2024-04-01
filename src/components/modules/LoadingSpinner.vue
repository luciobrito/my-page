<template>

<div class="background"><p><span class="loader"></span></p></div>
</template>

<style lang="scss">
.background{
    background-color: rgba(0, 0, 0, 0.247);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
    position: fixed;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    overflow: auto;
    backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);
}
.loader {
    width: 48px;
    height: 48px;
    border: 5px solid #ffffff00;
    border-bottom-color: #0059ff;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
    z-index: 5;
    }

    @keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    } </style>