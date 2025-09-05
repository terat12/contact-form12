<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $searchKeyword      = trim((string) $request->input('q', ''));
        $matchType          = $request->input('match', 'partial');
        $genderValue        = $request->input('gender');
        $selectedCategoryId = $request->input('category_id');
        $selectedDate       = $request->input('date');

        $query = Contact::with('category')->orderBy('id', 'asc');

        // 1) 検索
        if ($searchKeyword !== '') {
            $query->where(function ($subQuery) use ($searchKeyword, $matchType) {
                if ($matchType === 'exact') {
                    $subQuery->where('last_name', $searchKeyword)
                        ->orWhere('first_name', $searchKeyword)
                        ->orWhere('email', $searchKeyword)
                        ->orWhereRaw("CONCAT(last_name, ' ', first_name) = ?", [$searchKeyword])
                        ->orWhereRaw("CONCAT(last_name, first_name) = ?", [$searchKeyword]);
                } else {
                    $like = "%{$searchKeyword}%";
                    $subQuery->where('last_name', 'like', $like)
                        ->orWhere('first_name', 'like', $like)
                        ->orWhere('email', 'like', $like)
                        ->orWhereRaw("CONCAT(last_name, ' ', first_name) like ?", [$like])
                        ->orWhereRaw("CONCAT(last_name, first_name) like ?", [$like]);
                }
            });
        }

        // 2) 性別
        if (in_array($genderValue, ['1', '2', '3'], true)) {
            $query->where('gender', (int) $genderValue);
        }

        // 3) お問い合わせ
        if (!empty($selectedCategoryId)) {
            $query->where('category_id', (int) $selectedCategoryId);
        }

        // 4) 日付 <input type="date">
        if (!empty($selectedDate)) {
            $query->whereDate('created_at', $selectedDate);
        }

        // ページでページネーション
        $contacts   = $query->paginate(7)->withQueryString();
        $categories = Category::orderBy('id')->get();


        return view('admin.index', [
            'contacts'   => $contacts,
            'categories' => $categories,
            'filters'    => [
                'q'           => $searchKeyword,
                'match'       => $matchType,
                'gender'      => $genderValue,
                'category_id' => $selectedCategoryId,
                'date'        => $selectedDate,
            ],
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()
            ->route('admin.index', request()->query()) // ← クエリ維持
            ->with('status', '削除しました');
    }
}
