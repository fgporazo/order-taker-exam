@props(['id'])

<template id="{{ $id }}">
    <swal-title>
        {{ $title }}
    </swal-title>
    <swal-icon type="question" color="gray"></swal-icon>
    <swal-button type="confirm">
        Yes
    </swal-button>
    <swal-button type="cancel">
        Cancel
    </swal-button>
    <swal-param name="allowEscapeKey" value="false" />
    <swal-param
        name="customClass"
        value='{ "popup": "my-popup" }' />
    </template>