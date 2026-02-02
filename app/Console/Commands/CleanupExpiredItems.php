<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Word;
use App\Models\Discussion;
use App\Models\Reply;

class CleanupExpiredItems extends Command
{
    /**
     * Artisan command name
     */
    protected $signature = 'cleanup:expired 
                            {--force : Permanently delete instead of soft deleting}
                            {--log : Log deletion summary to storage logs}';

    /**
     * Description
     */
    protected $description = 'Delete expired words, discussions, and replies with optional force delete and logging.';

    /**
     * Handle the command execution
     */
    public function handle(): void
    {
        $isForceDelete = $this->option('force');
        $shouldLog = $this->option('log');

        $this->info('🧹 Starting expired data cleanup...');

        // Transaction for safety
        DB::beginTransaction();

        try {
            $wordCount = $this->deleteExpired(Word::class, $isForceDelete);
            $discussionCount = $this->deleteExpired(Discussion::class, $isForceDelete);
            $replyCount = $this->deleteExpired(Reply::class, $isForceDelete);

            DB::commit();

            $summary = "✅ Deleted: $wordCount words, $discussionCount discussions, $replyCount replies";

            // Console output
            $this->info($summary);

            // Optional logging
            if ($shouldLog) {
                Log::info('[CleanupExpiredItems]', [
                    'timestamp' => now()->toDateTimeString(),
                    'force_delete' => $isForceDelete,
                    'deleted' => [
                        'words' => $wordCount,
                        'discussions' => $discussionCount,
                        'replies' => $replyCount,
                    ],
                ]);
            }

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('❌ Cleanup failed', ['error' => $e->getMessage()]);
            $this->error('❌ Cleanup failed: ' . $e->getMessage());
        }
    }

    /**
     * Helper method: delete expired items for a model.
     */
    protected function deleteExpired(string $model, bool $force = false): int
    {
        $query = $model::where('expires_at', '<', now());

        if ($force && in_array('Illuminate\\Database\\Eloquent\\SoftDeletes', class_uses($model))) {
            return $query->forceDelete();
        }

        return $query->delete();
    }
}
