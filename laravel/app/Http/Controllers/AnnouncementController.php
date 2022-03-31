<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\News;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAnnouncements(Request $request,$type)
    {

        $posts=null;
        switch ($type) 
        {
            case 'announcements':
            $posts = Announcement::latest()
            ->limit(40)
            ->orderBy('created_at', 'desc')
            ->with('images')
            ->paginate(5)
            ->setPageName('page1');
            //the request is from ajax loading more data
            if ($request->ajax()) 
            {
                $posts = Announcement::latest()
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->paginate(5,['*'],'page1',$_GET['page1'])
                ->getCollection();
                return response()->json(['posts'=>$posts]);
            }
                break;

            case 'news':
            $posts = News::latest()
            ->limit(40)
            ->orderBy('created_at', 'desc')
            ->with('images')
            ->paginate(5)
            ->setPageName('page1');
            //the request is from ajax loading more data
            if ($request->ajax()) 
            {
                $posts = News::latest()
                ->orderBy('created_at', 'desc')
                ->with('images')
                ->paginate(5,['*'],'page1',$_GET['page1'])
                ->getCollection();
                return response()->json(['posts'=>$posts]);
            }
                break;
            
            default:
                # code...
                break;
        }

        return view('bana.infoCenterPage',['posts'=>$posts->getCollection(),'type'=>$type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
