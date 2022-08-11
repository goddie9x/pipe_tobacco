<?php
namespace App\Controllers\Admin;
use Core\Controller;
use App\Models\Site;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }
    public function save($request)
    {
        $site = new Site();
        $logo = isset($request->site_logo)?$request->site_logo:'';
        $favicon = isset($request->site_favicon)?$request->site_favicon:'';
        $isSubmitCommon = isset($request->submit_common);
        $isSubmitSocial = isset($request->submit_social);
        if ($logo!='') {
            try{
                $logo['name'] = preg_replace('/(.*)\.(.*)/', 'logo.$2', $logo['name']);
                if (move_uploaded_file($logo['tmp_name'], 'public/images/' . $logo['name'])) {
                    $site->logo = $logo['name'];
                    $site->where(['site_id'=> 1])->update(['site_logo' => $logo['name']]);
                    return redirect()->back(['success' => 'Logo has been updated']);
                }
                else{
                    return redirect()->back(['error' => 'Logo has not been updated']);
                }
            }
            catch(\Exception $e){
                writeLog($e);
                return redirect()->back(['error' => $e->getMessage()]);
            }
        }
        if ($favicon!='') {
            try{
                $favicon['name'] = preg_replace('/(.*)\.(.*)/', 'favicon.$2', $favicon['name']);
                if (move_uploaded_file($favicon['tmp_name'], 'public/images/' . $favicon['name'])) {
                    $site->favicon = $favicon['name'];
                }
                $site->where(['site_id'=> 1])->update(['site_favicon' => $favicon['name']]);
                return redirect()->back(['success'=> 'Favicon has been updated']);
            }
            catch(\Exception $e){
                writeLog($e);
                return redirect()->back(['error'=> $e->getMessage()]);
            }
        }
        if ($isSubmitCommon) {
           $isUpateSuccess =  $site->where(['site_id'=> 1])->update([
                'site_name' => $request->site_name,
                'site_email' => $request->site_email,
                'site_phone' => $request->site_phone,
                'site_address' => $request->site_address,
                'site_description' => $request->site_description,
                'site_keywords' => $request->site_keywords,
                'site_copyright' => $request->site_copyright,
                'site_map' => $request->site_map,
            ]);
            if ($isUpateSuccess) {
                return redirect()->back(['success'=> 'Common setting has been updated']);
            }
            else {
                return redirect()->back(['error' => 'Update failed']);
            }
        }
        if($isSubmitSocial){
            $isUpateSuccess = $site->where(['site_id' => 1])->update([
                'site_facebook' => $request->site_facebook,
                'site_twitter' => $request->site_twitter,
                'site_google' => $request->site_google,
                'site_youtube' => $request->site_youtube,
            ]);
            if ($isUpateSuccess) {
                return redirect()->back(['success'=> 'Social setting has been updated']);
            }
            else {
                return redirect()->back(['error' => 'Update failed']);
            }
        }
    }
}
