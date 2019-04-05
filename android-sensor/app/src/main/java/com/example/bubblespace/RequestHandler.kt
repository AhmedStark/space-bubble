package com.example.bubblespace

import android.content.Context
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.toolbox.Volley
import org.json.JSONObject
import com.android.volley.Response
import com.android.volley.toolbox.JsonObjectRequest

class RequestHandler  (applicationContext:Context,apiLink:String){
    private var  mRequestQueue: RequestQueue = Volley.newRequestQueue(applicationContext)
    private val apiLink = apiLink

    companion object {
        public val REQUEST_SUCCESS = 0
        public val REQUEST_DENIED_BY_CLIENT = 1
        public val REQUEST_DENIED_BY_SERVER = 2
    }

    fun sendStatusRequest(state:Boolean):Int{
        val params = JSONObject()
        params.put("vacant",state.toString())


        var jsonRequest = JsonObjectRequest(Request.Method.POST,apiLink ,params,
            Response.Listener { response ->  println("SS ::: $response") },
            Response.ErrorListener { error ->  println("ERROR::"+error)})



        mRequestQueue.add(jsonRequest)
        return 0

    }


}