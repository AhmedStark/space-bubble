package com.example.bubblespace

import android.app.Service
import android.content.Context
import android.content.Intent
import android.hardware.Sensor
import android.hardware.SensorEvent
import android.hardware.SensorEventListener
import android.hardware.SensorManager
import android.os.IBinder

class SensorReader: Service(), SensorEventListener {
    private lateinit var sensorManager: SensorManager
    private lateinit var lightSensor:Sensor
    private lateinit var requestHandler: RequestHandler
    private var vacant:Boolean=false
    private var sentStatus = false

    companion object {
        const val LIGHT_VALUE = 10
        const val STATE_CHANGED = 0
    }
    override fun onAccuracyChanged(sensor: Sensor?, accuracy: Int) {

    }

    override fun onSensorChanged(event: SensorEvent?) {
        var sensorReadValue = event!!.values[0]

        if (sensorReadValue<LIGHT_VALUE&&this.vacant){
            this.sentStatus = true
            this.vacant = false
        }
        if(sensorReadValue> LIGHT_VALUE&&!this.vacant){
            this.sentStatus = true
            this.vacant = true
        }
        println("VACANT :: $vacant")
        if (sentStatus){
            println("Sending request ")
            println("REQUEST STATE :: ${sendChangeStateRequest()}")
            this.sentStatus = false
            requestHandler.sendStatusRequest(this.vacant)

        }
        println("READ :: $sensorReadValue")
    }



    override fun onCreate() {
        requestHandler = RequestHandler(applicationContext,getString(R.string.api_link),getString(R.string.token))
        sensorManager = getSystemService(Context.SENSOR_SERVICE) as SensorManager
        lightSensor = sensorManager.getDefaultSensor(Sensor.TYPE_LIGHT)
        lightSensor?.also {
            sensorManager.registerListener(this,lightSensor,SensorManager.SENSOR_DELAY_NORMAL)
        }

        println("Hello world")
        super.onCreate()
    }
    override fun onBind(intent: Intent?): IBinder? {
        TODO("not implemented")
        return null
    }

    fun sendChangeStateRequest():Int{
        return STATE_CHANGED
    }
}