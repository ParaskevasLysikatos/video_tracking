
var videoId ;
var source ;

document.addEventListener('click',reply_click, true);
function reply_click(event) {
    source=event.target.id;
    videoId=event.target;

     var temp;

    document.addEventListener('mouseover',otherplay, true);
    function otherplay(event) {
        //console.log("initial playing video, event target id is: "+source)
       temp=event.target.id;
       //console.log("temp event target id is: "+temp)
        if(temp!=source && temp.length>0){pauseVid();}
    }

}



    function pauseVid() {
        document.getElementById(source).pause();
        clearSecfunction();
    }

    document.addEventListener('click', init, true);

    var name;
    var event;
    var timeStart;
    var timeEnd;
    var progress;
    var ptime;
    var myStop;
    var counter = 0;
    var lastSeek = 0;
    var second;
    var user = document.getElementById('nm').value = document.getElementById("nm").innerHTML;
    var user_name = String(user);


    function lastS(t) {
        lastSeek = t;
    }

    function myTime(iniTime) {
        iniTime = iniTime + 1;
        counter = iniTime;
    }


    function init() {
        videoId.addEventListener('ended', videoEnd, true);
        // videoId.addEventListener('timeupdate', videoTimeUpdate, false);
        videoId.addEventListener('play', videoPlay, true);
        videoId.addEventListener('pause', videoPause, true);
        videoId.addEventListener('seeking', videoSeeking, true);
    }

    function videoEnd() {
        clearTimeout(myStop);
        name = source;
        var nameQ = name.substring(0, name.length - 4);
        event = 'video ended ';
        var eventQ = event;
        timeStart = parseFloat(videoId.currentTime.toFixed(0));
        var tsq = timeStart;
        timeEnd = null;
        clearInterval(ptime);
        var teq = timeEnd;
        progress = parseFloat((parseFloat(timeStart).toFixed(0) / parseFloat(videoId.duration).toFixed(0)) * 100).toFixed(0);
        var pq = progress;
        var tp5=Math.floor(progress/5);
        var p5q=tp5*5;
        var dur = parseFloat(videoId.duration).toFixed(0);
        console.log(name + ' :' + event + '  Time_start:' + timeStart + '  Time_end:' + timeEnd + ' Progress' + progress + '% ' + user_name);
        jQuery.ajax({
            url: 'video_save',
            method: 'POST',
            data: {
                Qname: nameQ,
                Qevent: eventQ,
                QtimeStart: tsq,
                QtimeEnd: teq,
                Qprogress: pq,
                Qprogress5: p5q,
                Qduration: dur,
                Qusername: user_name
            },
            success: function () {
               // console.log('success ended');
            },
            error: function () {
                console.log('failed ended');
            }
        });
    }

    function videoPlay() {
        clearTimeout(myStop);
        name = source;
        var nameQ = name.substring(0, name.length - 4);
        event = 'video play ';
        var eventQ = event;
        timeStart = parseFloat(videoId.currentTime.toFixed(1));
        var tsq = timeStart;
        ptime = setInterval(myTime(timeStart), 1000);
        second = setInterval(videoSecondPlayed, 1000);
        timeEnd = null;
        var teq = timeEnd;
        progress = parseFloat((parseFloat(timeStart).toFixed(0) / parseFloat(videoId.duration).toFixed(0)) * 100).toFixed(0);
        var pq = progress;
        var tp5=Math.floor(progress/5);
        var p5q=tp5*5;
        var dur = parseFloat(videoId.duration).toFixed(0);
        console.log(name + ' :' + event + '  Time_start:' + timeStart + '  Time_end:' + timeEnd + ' Progress' + progress + '% ' + user_name);
        jQuery.ajax({
            url: 'video_save',
            method: 'POST',
            data: {
                Qname: nameQ,
                Qevent: eventQ,
                QtimeStart: tsq,
                QtimeEnd: teq,
                Qprogress: pq,
                Qprogress5: p5q,
                Qduration: dur,
                Qusername: user_name
            },
            success: function () {
               // console.log('success play');
            },
            error: function () {
                console.log('failed play');
            }
        });
    }

    function videoPause() {
        clearTimeout(myStop);
        clearInterval(second);
        myStop = setTimeout(videoStop, 10000)
        name = source;
        var nameQ = name.substring(0, name.length - 4);
        event = 'video paused ';
        var eventQ = event;
        timeStart = parseFloat(videoId.currentTime.toFixed(0));
        var tsq = timeStart;
        timeEnd = counter;
        clearInterval(ptime);
        var teq = timeEnd;
        progress = parseFloat((parseFloat(timeStart).toFixed(0) / parseFloat(videoId.duration).toFixed(0)) * 100).toFixed(0);
        var pq = progress;
        var tp5=Math.floor(progress/5);
        var p5q=tp5*5;
        var dur = parseFloat(videoId.duration).toFixed(0);
        console.log(name + ' :' + event + '  Time_start:' + timeStart + '  Time_end:' + timeEnd + ' Progress' + progress + '% ' + user_name);
        jQuery.ajax({
            url: 'video_save2',
            method: 'POST',
            data: {
                Qname: nameQ,
                Qevent: eventQ,
                QtimeStart: tsq,
                QtimeEnd: teq,
                Qprogress: pq,
                Qprogress5: p5q,
                Qduration: dur,
                Qusername: user_name
            },
            success: function () {
                console.log('success paused');
            },
            error: function () {
                console.log('failed paused');
            }
        });
    }

    // function videoTimeUpdate() {
    //     name = source;
    //     var nameQ = name.substring(0, name.length - 4);
    //     event = 'video update ';
    //     var eventQ = event;
    //     timeStart = parseFloat(videoId.currentTime.toFixed(0));
    //     var tsq = timeStart;
    //     timeEnd = null;
    //     var teq = timeEnd;
    //     progress = parseFloat((parseFloat(timeStart).toFixed(0) / parseFloat(videoId.duration).toFixed(0)) * 100).toFixed(0);
    //     var pq = progress;
    //     var tp5=Math.floor(progress/5);
    //     var p5q=tp5*5;
    //     var dur = parseFloat(videoId.duration).toFixed(0);
    //     console.log(name + ' :' + event + '  Time_start:' + timeStart + '  Time_end:' + timeEnd + ' Progress' + progress + '% ' + user_name);
    //     jQuery.ajax({
    //         url: 'video_save',
    //         method: 'POST',
    //         data: {
    //             Qname: nameQ,
    //             Qevent: eventQ,
    //             QtimeStart: tsq,
    //             QtimeEnd: teq,
    //             Qprogress: pq,
    //             Qprogress5: p5q,
    //             Qduration: dur,
    //             Qusername: user_name
    //         },
    //         success: function () {
    //             console.log('success update');
    //         },
    //         error: function () {
    //             console.log('failed update');
    //         }
    //     });

    // }

    function videoSeeking() {
        var win;
        name = source;
        var nameQ = name.substring(0, name.length - 4);
        clearTimeout(myStop);
        timeStart = parseFloat(videoId.currentTime.toFixed(0));
        var tsq = timeStart;
        clearInterval(ptime);
        if (lastSeek > counter) {
            win = lastSeek
        } else {
            win = counter;
        }
        timeEnd = win;
        var teq = timeEnd;
        progress = parseFloat((parseFloat(timeStart).toFixed(0) / parseFloat(videoId.duration).toFixed(0)) * 100).toFixed(0);
        var pq = progress;
        var tp5=Math.floor(progress/5);
        var p5q=tp5*5;
        if (timeStart > win) {
            event = 'video seeking forward ';
        } else {
            event = 'video seeking backward '
        }
        var eventQ = event;
        lastS(timeStart);
        if (timeStart === 0) {
            videoRestart();
        }
        var dur = parseFloat(videoId.duration).toFixed(0);
        console.log(name + ' :' + event + '  Time_FromJump: ' + timeEnd + '  Time_start:' + timeStart + ' Progress' + progress + '% ' + user_name);
        jQuery.ajax({
            url: 'video_save3',
            method: 'POST',
            data: {
                Qname: nameQ,
                Qevent: eventQ,
                QtimeStart: tsq,
                QtimeEnd: teq,
                Qprogress: pq,
                Qprogress5: p5q,
                Qplay: counter,
                Qduration: dur,
                Qusername: user_name
            },
            success: function () {
              // console.log('success seeking');
            },
            error: function () {
                console.log('failed seeking');
            }
        });
    }

    function videoStop() {
        clearTimeout(myStop);
        name = source;
        var nameQ = name.substring(0, name.length - 4);
        event = 'video stop';
        var eventQ = event;
        timeStart = parseFloat(videoId.currentTime.toFixed(0));
        var tsq = timeStart;
        timeEnd = null;
        var teq = timeEnd;
        progress = parseFloat((parseFloat(timeStart).toFixed(0) / parseFloat(videoId.duration).toFixed(0)) * 100).toFixed(0);
        var pq = progress;
        var tp5=Math.floor(progress/5);
        var p5q=tp5*5;
        var dur = parseFloat(videoId.duration).toFixed(0);
        console.log(name + ' :' + event + '  Time_start:' + timeStart + '  Time_end:' + timeEnd + ' Progress' + progress + '% ' + user_name);
        jQuery.ajax({
            url: 'video_save',
            method: 'POST',
            data: {
                Qname: nameQ,
                Qevent: eventQ,
                QtimeStart: tsq,
                QtimeEnd: teq,
                Qprogress: pq,
                Qprogress5: p5q,
                Qduration: dur,
                Qusername: user_name
            },
            success: function () {
              //  console.log('success stop');
            },
            error: function () {
                console.log('failed stop');
            }
        });
    }

    function videoRestart() {
        clearTimeout(myStop);
        name = source;
        var nameQ = name.substring(0, name.length - 4);
        event = 'video restart';
        var eventQ = event;
        timeStart = parseFloat(videoId.currentTime.toFixed(0));
        var tsq = timeStart;
        timeEnd = null;
        var teq = timeEnd;
        progress = parseFloat((parseFloat(timeStart).toFixed(0) / parseFloat(videoId.duration).toFixed(0)) * 100).toFixed(0);
        var pq = progress;
        var tp5=Math.floor(progress/5);
        var p5q=tp5*5;
        var dur = parseFloat(videoId.duration).toFixed(0);
        console.log(name + ' :' + event + '  Time_start:' + timeStart + '  Time_end:' + timeEnd + ' Progress' + progress + '% ' + user_name);
        jQuery.ajax({
            url: 'video_save',
            method: 'POST',
            data: {
                Qname: nameQ,
                Qevent: eventQ,
                QtimeStart: tsq,
                QtimeEnd: teq,
                Qprogress: pq,
                Qprogress5: p5q,
                Qduration: dur,
                Qusername: user_name
            },
            success: function () {
               // console.log('success restart');
            },
            error: function () {
                console.log('failed restart');
            }
        });
    }

    function videoSecondPlayed() {
        name = source;
        var nameQ = name.substring(0, name.length - 4);
        event = 'video second played';
        var eventQ = event;
        timeStart = parseFloat(videoId.currentTime.toFixed(0));
        var tsq = timeStart;
        timeEnd = null;
        var teq = timeEnd;
        progress = parseFloat((parseFloat(timeStart).toFixed(0) / parseFloat(videoId.duration).toFixed(0)) * 100).toFixed(0);
        var pq = progress;
        var tp5=Math.floor(progress/5);
        var p5q=tp5*5;
        var dur = parseFloat(videoId.duration).toFixed(0);
        console.log(name + ' :' + event + ':  second played:' + timeStart + ' Progress' + progress + '% ' + user_name);
        jQuery.ajax({
            url: 'video_save',
            method: 'POST',
            data: {
                Qname: nameQ,
                Qevent: eventQ,
                QtimeStart: tsq,
                QtimeEnd: teq,
                Qprogress: pq,
                Qprogress5: p5q,
                Qduration: dur,
                Qusername: user_name
            },
            success: function () {
               // console.log('success second played');
            },
            error: function () {
                console.log('failed second played');
            }
        });
    }

    function clearSecfunction() {
        clearInterval(second);
    }

 $(window).on('load', function () {
        jQuery.ajax({
            url: 'video_session',
            method: 'POST',
            data: {
                Qusername: user_name
            },
            success: function () {
                console.log('success session');
            },
            error: function () {
                console.log('failed session');
            }
        });
    });





