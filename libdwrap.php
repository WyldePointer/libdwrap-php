<?php
/*
 * Copyright (c) 2017, Sohrab Monfared <sohrab.monfared@gmail.com>
 * All rights reserved.

 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *    * Redistributions of source code must retain the above copyright
 *      notice, this list of conditions and the following disclaimer.
 *    * Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in the
 *      documentation and/or other materials provided with the distribution.
 *    * Neither the name of the <organization> nor the
 *      names of its contributors may be used to endorse or promote products
 *      derived from this software without specific prior written permission.

 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

function dwrap_do_a_lookup(array $params, $server_api_path){

  $query_string = NULL;
  $json = false;

  if (empty($server_api_path)){
    return -1;
  }

  /* TODO: Input validation: hostname/server_api_path */

  if (!isset($params["hostname"])){
    return -2;
  }

  $query_string = $server_api_path . "get_ip_by_name/" . $params["hostname"];

  if (isset($params["json"])){

    if ($params["json"] == true){

      $query_string .= "/json";

      $json = true;

    }

  }

  if (isset($params["limit"])){

    if ($params["limit"] === true || $params["limit"] === 1){

      $query_string .= "/limit/1";

    } else {

      if ($params["limit"] > 0){

        $query_string .= "/limit/" . $params["limit"];

      }

    }

  }

  $response = hugor_make_request(array(
    "url" => $query_string
  ));


  if ($json){

    if (json_decode($response) === NULL){

      return -1; /* Invalid JSON response from server */

    } else {

      return $response;

    }

  } else {

    /*
     * TODO: Checking the response header to make sure
     *       it was a valid dwrap response and not a 404 or something.
     */
    return $response;

  }


  return false;
}
