<template>
<div>
    <slot name="child-map"></slot>
</div>
</template>

<script>
export default {
    props:{
        enable_selecting:{default:false,type:Boolean}
        ,areas:{type:Array}
    },
    methods:{

    selectArea:function (id) {
                if(!this.enable_selecting){
                    return;
                }
                console.log("not Happenning")
                console.log("it is here "+id);
                var el=document.getElementById("area-"+id);
                console.log(el.getAttribute('width'));
                for(var i = 0 ;i<this.areas.length;i++){
                    
                    var area = this.areas[i];
                    if(id===area.id){
                        document.getElementById("area-"+area.id).style.opacity = 1.25;
                        continue;
                    }
                    var el=document.getElementById("area-"+area.id);

                    el.style.opacity = 0.5    
                }
    },
    },
}
</script>
