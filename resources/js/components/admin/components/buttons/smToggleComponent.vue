<template>
    <ul class="tg-list">
        <li class="tg-list-item">
            <!-- <h4>{{ value ? 'Available ' : 'Not Available ' }}</h4> -->
            <input class="tgl tgl-skewed" :id="id" type="checkbox" v-model="isChecked" @click="toggleCheckbox" />
            <label class="tgl-btn" :for="id" data-tg-off="OFF" data-tg-on="ON" for="cb3"></label>
        </li>
    </ul>
</template>


<script>
import LoadingComponent from "../LoadingComponent";

export default {
    name: "Toggle",
    components: { LoadingComponent },
    props: {
        id: String,
        value: Boolean,
        item: Object,
        search: Object,
    },
    data() {
        return {
            isChecked: this.value,
        };
    },

    methods: {
        toggleCheckbox() {
            // this.value = !value;
            console.log(!this.isChecked);
            try {
                const fd = new FormData();
                fd.append('name', this.item.name);
                fd.append('price', this.item.price);
                fd.append('item_category_id', this.item.item_category_id == null ? '' : this.item.item_category_id);
                fd.append('tax_id', this.item.tax_id == null ? '' : this.item.tax_id);
                fd.append('item_type', this.item.item_type);
                fd.append('is_featured', this.item.is_featured);
                fd.append('description', this.item.description);
                fd.append('caution', this.item.caution);
                fd.append('order', 1);
                fd.append('status', this.value ? "10" : "5");
                if (this.image) {
                    fd.append('image', this.image);
                }
                this.$store.dispatch("item/setTempId", { tempId: this.item.id, isEditing: true })

                const tempId = this.$store.getters['item/temp'].temp_id;
                // this.loading.isActive = true;
                console.log(tempId)
                this.$store.dispatch('item/save', {
                    form: fd,
                    search: this.search,
                    id: this.item.id
                }).then((res) => {
                    // appService.sideDrawerHide();
                    // this.loading.isActive = false;
                    alertService.successFlip((tempId === null ? 0 : 1), this.$t('menu.items'));
                    this.item = {
                        name: "",
                        price: "",
                        description: "",
                        caution: "",
                        is_featured: askEnum.YES,
                        item_type: itemTypeEnum.VEG,
                        item_category_id: null,
                        tax_id: null,
                        status: statusEnum.ACTIVE,
                    };
                    this.image = "";
                    this.errors = {};
                    this.$refs.imageProperty.value = null;
                }).catch((err) => {
                    // this.loading.isActive = false;
                    this.errors = err.response.data.errors;
                })
            } catch (err) {
                // this.loading.isActive = false;
                // alertService.error(err)
                console.log(err)
            }

        },
    },
};


</script>

<style scoped>
/* Styling for the toggle */
html,
body {
    display: flex;
    min-height: 100%;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-family: sans-serif;
}

ul,
li {
    list-style: none;
    margin: 0;
    padding: 0;
}

.tg-list {
    text-align: center;
    display: flex;
    align-items: center;
}

.tg-list-item {
    margin: 0 2em;
}

h2 {
    color: #777;
}

h4 {
    color: #999;
}

.tgl {
    display: none;

    &,
    &:after,
    &:before,
    & *,
    & *:after,
    & *:before,
    &+.tgl-btn {
        box-sizing: border-box;

        &::selection {
            background: none;
        }
    }

    +.tgl-btn {
        outline: 0;
        display: block;
        width: 4em;
        height: 2em;
        position: relative;
        cursor: pointer;
        user-select: none;

        &:after,
        &:before {
            position: relative;
            display: block;
            content: "";
            width: 50%;
            height: 100%;
        }

        &:after {
            left: 0;
        }

        &:before {
            display: none;
        }
    }

    &:checked+.tgl-btn:after {
        left: 50%;
    }
}


.tgl-light {
    +.tgl-btn {
        background: #f0f0f0;
        border-radius: 2em;
        padding: 2px;
        transition: all .4s ease;

        &:after {
            border-radius: 50%;
            background: #fff;
            transition: all .2s ease;
        }
    }

    &:checked+.tgl-btn {
        background: #9FD6AE;
    }
}

.tgl-ios {
    +.tgl-btn {
        background: #fbfbfb;
        border-radius: 2em;
        padding: 2px;
        transition: all .4s ease;
        border: 1px solid #e8eae9;

        &:after {
            border-radius: 2em;
            background: #fbfbfb;
            transition:
                left .3s cubic-bezier(0.175, 0.885, 0.320, 1.275),
                padding .3s ease, margin .3s ease;
            box-shadow:
                0 0 0 1px rgba(0, 0, 0, .1),
                0 4px 0 rgba(0, 0, 0, .08);
        }

        &:hover:after {
            will-change: padding;
        }

        &:active {
            box-shadow: inset 0 0 0 2em #e8eae9;

            &:after {
                padding-right: .8em;
            }
        }
    }

    &:checked+.tgl-btn {
        background: #86d993;

        &:active {
            box-shadow: none;

            &:after {
                margin-left: -.8em;
            }
        }
    }
}

.tgl-skewed {
    +.tgl-btn {
        overflow: hidden;
        border-radius: 20px;
        backface-visibility: hidden;
        transition: all .2s ease;
        font-family: sans-serif;
        background: red;

        &:after,
        &:before {

            display: inline-block;
            transition: all .2s ease;
            width: 100%;
            text-align: center;
            position: absolute;
            line-height: 2em;
            font-weight: bold;
            color: #fff;
            text-shadow: 0 1px 0 rgba(0, 0, 0, .4);
        }

        &:after {
            left: 100%;
            content: attr(data-tg-on);
        }

        &:before {
            left: 0;
            content: attr(data-tg-off);
        }

        &:active {
            background: #888;

            &:before {
                left: -10%;
            }
        }
    }

    &:checked+.tgl-btn {
        background: #86d993;

        &:before {
            left: -100%;
        }

        &:after {
            left: 0;
        }

        &:active:after {
            left: 10%;
        }
    }
}

.tgl-flat {
    +.tgl-btn {
        padding: 2px;
        transition: all .2s ease;
        background: #fff;
        border: 4px solid #f2f2f2;
        border-radius: 2em;

        &:after {
            transition: all .2s ease;
            background: #f2f2f2;
            content: "";
            border-radius: 1em;
        }
    }

    &:checked+.tgl-btn {
        border: 4px solid #7FC6A6;

        &:after {
            left: 50%;
            background: #7FC6A6;
        }
    }
}

.tgl-flip {
    +.tgl-btn {
        padding: 2px;
        transition: all .2s ease;
        font-family: sans-serif;
        perspective: 100px;

        &:after,
        &:before {
            display: inline-block;
            transition: all .4s ease;
            width: 100%;
            text-align: center;
            position: absolute;
            line-height: 2em;
            font-weight: bold;
            color: #fff;
            position: absolute;
            top: 0;
            left: 0;
            backface-visibility: hidden;
            border-radius: 4px;
        }

        &:after {
            content: attr(data-tg-on);
            background: #02C66F;
            transform: rotateY(-180deg);
        }

        &:before {
            background: #FF3A19;
            content: attr(data-tg-off);
        }

        &:active:before {
            transform: rotateY(-20deg);
        }
    }

    &:checked+.tgl-btn {
        &:before {
            transform: rotateY(180deg);
        }

        &:after {
            transform: rotateY(0);
            left: 0;
            background: #7FC6A6;
        }

        &:active:after {
            transform: rotateY(20deg);
        }
    }
}
</style>
