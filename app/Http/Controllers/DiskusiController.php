<?php

namespace App\Http\Controllers;

use App\Models\Diskusi;
use App\Models\MappingGrup;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\ChatEvent;
use App\Models\DetailDiskusi;
use App\Models\DetailTransaksi;
use App\Models\MappingSubGrup;
use App\Models\User;

class DiskusiController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $userId = auth()->id();
            $grups = MappingGrup::whereHas('mapping_sub_grups')->get();
            $diskusis = Diskusi::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
            return view('dashboard.diskusi.room', compact('diskusis', 'grups'));
        } else {
            $grups = MappingGrup::whereHas('mapping_sub_grups')->get();
            $diskusis = Diskusi::orderBy('created_at', 'desc')->get();
            $admin = auth()->guard('pegawai')->id();
            return view('dashboard.diskusi.room', compact('diskusis', 'grups'));
        }
    }

    public function store(Request $request)
    {
        // getting grup id
        $id_grup = $request->grup;
        // getting grup values
        $grups = MappingGrup::find($id_grup);
        // getting transaction id
        $id_transaksi = $grups->transaksi_id;
        // getting transaction value
        $transaksi = transaksi::find($id_transaksi);
        // getting user id
        $id_user = $transaksi->user_id;

        $diskusi = new Diskusi();
        $diskusi->mapping_grup_id = $request->input('grup');
        $diskusi->user_id = $id_user;
        $diskusi->transaksi_id = $id_transaksi;
        $diskusi->tipe_diskusi = $request->input('tipe');
        $success = $diskusi->save();

        if ($success) {
            toast('Discussion Room Created Successfully', 'success');
            return redirect(route('index-diskusi'));
        } else {
            toast('Discussion Room Failed to Create', 'failed');
        }
    }

    public function room($room)
    {
        // // return $room;
        // $diskusi = Diskusi::find($room);
        // $id_diskusi = $diskusi->id;
        // $mapping_grup_id = $diskusi->mapping_grup_id;
        // $mapping_grup = MappingGrup::find($mapping_grup_id);
        // $id_grup = $mapping_grup->id;
        // $sub_grup = MappingSubGrup::where('mapping_grup_id', $id_grup)->get();
        // return $sub_grup;
        // $id_pegawai_sub = $sub_grup->pegawai_id;
        // $id_pegawai_grup = $mapping_grup->pegawai_id;
        // // return $id_pegawai_grup;
        // if (auth()->guard('pegawai')->check()) {
        //     $my_id = auth()->guard('pegawai')->id();
        //     $target_id = $diskusi->user_id;
        //     if ($my_id == $id_pegawai_grup || $my_id == $id_pegawai_sub) {
        //         // $my_room = Diskusi::where('mapping_grup_id', $mapping_grup_id);
        //         $room = Diskusi::where('id', $id_diskusi)->first();
        //         return view('dashboard.diskusi.chat', compact('room', 'id_pegawai_grup', 'target_id'));
        //     }
        //     // $id_mapping_pegawai_diskusi = MappingGrup::find($mapping_grup_id);
        // } else {
        //     $my_id = auth()->id();
        //     $user = User::find($my_id);
        //     $nama_user = $user->name;
        //     $target_id = $id_pegawai_grup;
        //     $room = Diskusi::where('id', $id_diskusi)->first();
        //     return view('dashboard.diskusi.chat', compact('room', 'my_id', 'target_id', 'nama_user'));
        // }

        $diskusi = Diskusi::find($room);
        if ($diskusi) {
            $id_diskusi = $diskusi->id;
            $mapping_grup_id = $diskusi->mapping_grup_id;

            $mapping_grup = MappingGrup::find($mapping_grup_id);
            if ($mapping_grup) {
                $id_grup = $mapping_grup->id;

                // Ambil semua MappingSubGrup berdasarkan mapping_grup_id
                $sub_grups = MappingSubGrup::where('mapping_grup_id', $id_grup)->get();

                // Kumpulkan semua pegawai_id dari subgrup
                $id_pegawai_subs = $sub_grups->pluck('pegawai_id')->all();

                // Tambahkan pegawai_id dari mapping_grup ke daftar pegawai_id
                $id_pegawai_grup = $mapping_grup->pegawai_id;
                $id_pegawai_subs[] = $id_pegawai_grup;

                // Hapus duplikasi pegawai_id jika ada
                $id_pegawai_subs = array_unique($id_pegawai_subs);

                // Ambil ID pengguna yang sedang login
                $my_id = auth()->guard('pegawai')->id();
                $target_id = $diskusi->user_id;

                // Cek apakah my_id ada di dalam id_pegawai_subs
                if (in_array($my_id, $id_pegawai_subs)) {
                    // Dapatkan room diskusi
                    $room = Diskusi::where('id', $id_diskusi)->first();
                    $id_transaksi = $room->transaksi_id;
                    $det_transaksi = DetailTransaksi::where('transaksi_id', $id_transaksi)->get();
                    return view('dashboard.diskusi.chat', compact('room', 'id_pegawai_grup','target_id', 'det_transaksi'));
                } else {
                    $my_id = auth()->id();
                    $user = User::find($my_id);
                    $nama_user = $user->name;
                    $target_id = $id_pegawai_grup;
                    $room = Diskusi::where('id', $id_diskusi)->first();
                    $id_transaksi = $room->transaksi_id;
                    $det_transaksi = DetailTransaksi::where('transaksi_id', $id_transaksi)->get();
                    return view('dashboard.diskusi.chat', compact('room', 'my_id', 'target_id', 'nama_user', 'det_transaksi'));
                }
            } else {
                // Tangani kasus jika tidak ada mapping_grup yang ditemukan
                // Contoh: return redirect()->back()->with('error', 'Grup tidak ditemukan.');
            }
        } else {
            // Tangani kasus jika tidak ada diskusi yang ditemukan
            // Contoh: return redirect()->back()->with('error', 'Diskusi tidak ditemukan.');
        }
    }

    public function getChat($room)
    {
        // $chats = DetailDiskusi::where('diskusi_id', $room)->get();
        // $chats = DetailDiskusi::join('users', 'users.id', '=', 'detail_diskusis.user_id')
        //     ->join('pegawais', 'pegawais.id', '=', 'detail_diskusis.pegawai_id')
        //     ->where('diskusi_id', $room)
        //     ->select('detail_diskusis.*', 'users.name as user_name', 'pegawais.name as anonym')
        //     ->get();
        $chats = DetailDiskusi::leftJoin('users', 'users.id', '=', 'detail_diskusis.user_id')
            ->leftJoin('pegawais', 'pegawais.id', '=', 'detail_diskusis.pegawai_id')
            ->where('diskusi_id', $room)
            ->select('detail_diskusis.*', 'users.name as user_name', 'pegawais.name as anonym')
            ->get();
        return response()->json($chats);
        // if(auth()->guard('pegawai')->check()){
        //     $chats = DB::table('detail_diskusis')
        //         ->join('pegawais', 'pegawais.id', '=', 'detail_diskusis.pegawai_id')
        //         ->join('users', 'users.id', '=', 'detail_diskusis.user_id')
        //         ->where('diskusi_id', $room)
        //         ->select('detail_diskusis.*', 'users.name as user_name', 'pegawais.name as anonym')
        //         ->get();
        //     return response()->json($chats);
        // }else{
        //     $chats = DB::table('detail_diskusis')
        //         ->join('pegawais', 'pegawais.id', '=', 'detail_diskusis.pegawai_id')
        //         ->join('users', 'users.id', '=', 'detail_diskusis.user_id')
        //         ->where('diskusi_id', $room)
        //         ->select('detail_diskusis.*', 'users.name as user_name', 'pegawais.name as anonym')
        //         ->get();

        //     return response()->json($chats);
        // }
    }

    public function sendChat(Request $request)
    {
        if (auth()->guard('pegawai')->check()) {
            $chat = DB::table('detail_diskusis')->insert([
                'diskusi_id' => $request->room,
                'pegawai_id' => auth()->guard('pegawai')->id(),
                'user_id' => null,
                'text' => $request->message,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            // Trigger event
            broadcast(new ChatEvent($request->room, $request->message, auth()->guard('pegawai')->id()));

            return response()->json($chat);
        } else {
            $chat = DB::table('detail_diskusis')->insert([
                'diskusi_id' => $request->room,
                'user_id' => auth()->user()->id,
                'pegawai_id' => null,
                'text' => $request->message,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Trigger event
            broadcast(new ChatEvent($request->room, $request->message, auth()->user()->id));

            return response()->json($chat);
        }
    }
}
