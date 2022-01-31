<template>
    <div :class="type" class="tooltip-wrapper">
        <div ref="tooltip">
            <slot/>
        </div>

        <div ref="content" class="content">
            <slot name="content"/>
            <div class="arrow" data-popper-arrow/>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    import { createPopper } from "@popperjs/core"
    import {
        onMounted,
        ref,
    }                       from "vue"

    export default {
        name: "Tooltip",

        props: {
            placement: { type: String, required: false, default: "top" },
            type: { type: String, required: false, default: "default" },
        },

        setup(props) {
            const tooltip = ref(null)
            const content = ref(null)

            onMounted(() => {
                createPopper(tooltip.value, content.value, {
                    placement: props.placement,
                    modifiers: [
                        {
                            name: "offset",
                            options: {
                                offset: [0, 8],
                            },
                        },
                    ],
                })
            })

            return { tooltip, content }
        },
    }
</script>

<style lang="scss">
    .tooltip-wrapper {
        position: relative;
        display: inline-block;

        &.success .content {
            background: #10b981;
            color: #fff;
        }

        &.danger .content {
            background: #ef4444;
            color: #fff;
        }

        &.info .content {
            background: #3b82f6;
            color: #fff;
        }

        &.warning .content {
            background: #f59e0b;
            color: #fff;
        }

        &.default .content {
            background: #337CAC;
            color: #fff;
        }

        &:hover .content {
            visibility: visible;

            .arrow::before {
                visibility: visible;
            }
        }

        .content {
            visibility: hidden;
            display: inline-block;
            font-weight: bold;
            padding: 5px 10px;
            font-size: 13px;
            border-radius: 4px;
            white-space: nowrap;

            .arrow,
            .arrow::before {
                position: absolute;
                width: 8px;
                height: 8px;
                background: inherit;
            }

            .arrow {
                visibility: hidden;
            }

            .arrow::before {
                visibility: hidden;
                content: '';
                transform: rotate(45deg);
            }
        }
    }

    .content[data-popper-placement^='top'] > .arrow {
        bottom: -4px;
    }

    .content[data-popper-placement^='bottom'] > .arrow {
        top: -4px;
    }

    .content[data-popper-placement^='left'] > .arrow {
        right: -4px;
    }

    .content[data-popper-placement^='right'] > .arrow {
        left: -4px;
    }
</style>
