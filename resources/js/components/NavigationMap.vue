<template>
<!-- Created with Inkscape (http://www.inkscape.org/) -->
<main-map :areas="areas" ref="main_map">
<div slot="child-map" >
<slot name="map"></slot>
</div>
</main-map>
</template>
<script>
export default {
    data:function(){
        return{
            areas:[
                {id:"w",direct:"1"},
                {id:"n",direct:"1"},
                {id:"z",direct:"1"},
                {id:"s",direct:"1"},
                {id:"m",direct:"1"},
                {id:"o",direct:"1"},
                {id:"p",direct:"1"},
                {id:"d"},
                {id:"e"},
                {id:"u",direct:"1"},
                {id:"c",direct:"1"},
                {id:"b"},
                {id:"e"},
                {id:"a",direct:"1"},
                {id:"g",direct:"1"},
                {id:"f"},
                {id:"y"},
                {id:"t",direct:"1"},
                {id:"h",direct:"1"},
                {id:"r"},
                ]
        }
    },
    methods:{
        changeColor:function () {
                for(var i = 0 ;i<this.areas.length;i++){
                    var area = this.areas[i];
                    var el=document.getElementById("area-"+area.id);
                    el.addEventListener("mouseover",this.mouseOverMapEvent);
                    el.addEventListener("mouseout",this.mouseOutMapEvent);
                    el.areaID = "area-"+ area.id;
                    el.areaIndex = i;
                    this.areas[i].color=el.style.fill;


                     if(area.direct!==undefined){
                        el.direct=area.direct;
                        el.addEventListener("click",this.clickMapEvent);
                        el.style.cursor ="pointer"
                    }
                }
            },mouseOverMapEvent:function(evt){
                var el = document.getElementById(evt.target.areaID);
                el.style.fill = "blue";
            },mouseOutMapEvent:function(evt){
                var el = document.getElementById(evt.target.areaID);
                el.style.fill = this.areas[el.areaIndex].color;
            },
            clickMapEvent:function(evt){
                window.location = 'http://localhost:8000/map/'+evt.target.direct;
            },selectArea(id){
                this.$refs.main_map.selectArea(id);
            },
    },mounted(){
        this.changeColor();
    }
}
</script>
