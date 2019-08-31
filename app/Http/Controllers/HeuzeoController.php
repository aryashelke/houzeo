<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Film;
use App\People;
use App\PeopleFilmMapping;

use Auth;
use Carbon\Carbon;

class HeuzeoController extends Controller
{
    private static $_peopleUrl = "https://swapi.co/api/people/";
	private static $_filmUrl = "https://swapi.co/api/films/";

	public function index(){

		$view_data = [
			'people_url' => static::$_peopleUrl,
			'film_url' => static::$_filmUrl,
		];

		return view('form', $view_data)->render();
	}

    public function listView(){

        return view('list.list')->render();
    }

    public function savePeople(Request $request){

        $current_user = Auth::user()->id;
    	$input_people_data = $request->all();
    	$index = $input_people_data['index'];
        $film_list = $input_people_data['film'];
        $input_people_data['updated_by'] = $current_user;

    	$people_info = People::where('index', $index)->active()->first();
    	if (null === $people_info) {
    		$people_info = new People;
            $input_people_data['created_by'] = $current_user;
    	}

        unset($input_people_data['film']);
    	$people_info->fill($input_people_data);
    	$save_people = $people_info->save();

        if (isset($film_list) && trim($film_list) !== "") {
            
            $film_list = explode(",", $film_list);
            
            foreach ($film_list as $film) {
                $film_index = trim(explode(static::$_filmUrl, $film)[1], '/');
                static::peopleFilmMapping($index, $film_index);
            }
        }

    	if ($save_people) {
    		return [
	    		'code' => 200,
	    		'success' => true,
	    		'message' => 'People successfully saved',
	    	];
    	}
    	return [
    		'code' => 500,
    		'success' => false,
    		'message' => 'Failed to save the data',
    	];
    }


    public function saveFilm(Request $request){

        $current_user = Auth::user()->id;
    	$input_film_data = $request->all();
    	$index = $input_film_data['index'];
        $prople_list = $input_film_data['characters'];
        $input_film_data['updated_by'] = $current_user;

    	$film_info = Film::where('index', $index)->active()->first();
    	if (null === $film_info) {
    		$film_info = new Film;
            $input_film_data['created_by'] = $current_user;
    	}

        unset($input_film_data['characters']);
    	$film_info->fill($input_film_data);
    	$save_film = $film_info->save();

        if (isset($prople_list) && trim($prople_list) !== "") {
            
            $prople_list = explode(",", $prople_list);
            
            foreach ($prople_list as $prople) {
                $prople_index = trim(explode(static::$_peopleUrl, $prople)[1], '/');
                static::peopleFilmMapping($prople_index, $index);
            }
        }

    	if ($save_film) {
    		return [
	    		'code' => 200,
	    		'success' => true,
	    		'message' => 'Film successfully saved',
	    	];
    	}

    	return [
    		'code' => 500,
    		'success' => false,
    		'message' => 'Failed to save the data',
    	];
    }

    private static function peopleFilmMapping($people_index, $film_index){

        $film_info = Film::select('id')->where('index', $film_index)->active()->first();
        $people_info = People::select('id')->where('index', $people_index)->active()->first();
        
        if (null === $people_info || null === $film_info) {
            return [
                'code' => 500,
                'success' => false,
                'message' => 'No film or people found to map',
            ];
        }

        $film_id = $film_info->id;
        $people_id = $people_info->id;
        $current_user = Auth::user()->id;

        $people_film_mapping_info = PeopleFilmMapping::where('film_id', $film_id)->where('people_id', $people_id)->first();

        $updation_array = [
            'film_id' => $film_id,
            'people_id' => $people_id,
            'updated_by' =>$current_user,
        ];

        if (null === $people_film_mapping_info) {

            $updation_array['created_by'] = $current_user;
            $people_film_mapping_info = new PeopleFilmMapping;
        }

        $people_film_mapping_info->fill($updation_array);
        $insert_update_mapping = $people_film_mapping_info->save();

        if ($insert_update_mapping) {
            return [
                'code' => 200,
                'success' => true,
                'message' => 'People and film mapping successful',
            ];
        }

        return [
            'code' => 500,
            'success' => false,
            'message' => 'No film or people map! Server error',
        ];

    }

    public function getPeopleList(Request $request){


        $index = 0;
        $final_list_array = [];
        $search_value = $request['search']['value'];

        $people_list = People::active();

        if (isset($search_value) && trim($search_value) !== "") {
            $people_list = $people_list->whereRaw("`name` LIKE '%" . $search_value . "%' OR height LIKE '%" . $search_value . "%' OR unit_of_height LIKE '%" . $search_value . "%'");
        }

        $total_count = $people_list->count();
        $people_list = $people_list->orderBy('id', 'DESC')->get();

        if (null !== $people_list && $people_list->isNotEmpty()) {

            foreach ($people_list as $people) {

                $index = $index + 1;
                $people_id = $people->id;
                $people_name = $people->name;
                $row_of_action = view('list.film-row', compact('people_id'))->render();
                $people_height = implode(' ', [ $people->height, $people->unit_of_height ]);
                $final_list_array[] = [ $index , $people_name, $people_height, $row_of_action ];
            }
        }

        $list_array = [
            'draw' => $request['draw'],
            'recordsFiltered' => $total_count,
            'recordsTotal' => $total_count,
            'data' => $final_list_array,
        ];

        echo json_encode($list_array);
    }

    public function getFilmList(Request $request){


        $index = 0;
        $final_list_array = [];
        $search_value = $request['search']['value'];

        $film_list = Film::active();

        if (isset($search_value) && trim($search_value) !== "") {
            $film_list = $film_list->whereRaw("`name` LIKE '%" . $search_value . "%' OR director LIKE '%" . $search_value . "%'");
        }

        $total_count = $film_list->count();
        $film_list = $film_list->orderBy('id', 'DESC')->get();

        if (null !== $film_list && $film_list->isNotEmpty()) {

            foreach ($film_list as $film) {

                $index = $index + 1;
                $film_id = $film->id;
                $film_name = $film->name;
                $film_director = $film->director;
                $row_of_action = view('list.people-row', compact('film_id'))->render();
                $final_list_array[] = [ $index , $film_name, $film_director, $row_of_action ];
            }
        }

        $list_array = [
            'draw' => $request['draw'],
            'recordsFiltered' => $total_count,
            'recordsTotal' => $total_count,
            'data' => $final_list_array,
        ];

        echo json_encode($list_array);
    }

    public function getWorkedFilm($people_id){

        $film_list = Film::active()->whereIn('id', function($query)use($people_id){
            $query->select('film_id')->from(with(new PeopleFilmMapping)->getTable())->where('people_id', $people_id);
        })->get();

        $view = null;

        if (null !== $film_list && $film_list->isNotEmpty()) {

            $index = 0;
            foreach ($film_list as $film) {
                $index = $index + 1;
                $view .= "<li>" . $index . ". " .$film->name . "</li>";
            }
        }else{
            $view .= "<li> No Record found </li>";   
        }

        return $view;
    }

    public function getWorkedPeople($film_id){

        $people_list = People::active()->whereIn('id', function($query)use($film_id){
            $query->select('people_id')->from(with(new PeopleFilmMapping)->getTable())->where('film_id', $film_id);
        })->get();

        $view = null;

        if (null !== $people_list && $people_list->isNotEmpty()) {

            $index = 0;
            foreach ($people_list as $people) {
                $index = $index + 1;
                $view .= "<li>" . $index . ". " . $people->name . "</li>";
            }
        }else{
            $view .= "<li> No Record found </li>";   
        }

        return $view;
    }
}
