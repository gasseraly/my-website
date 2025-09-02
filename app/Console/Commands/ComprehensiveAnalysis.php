<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class ComprehensiveAnalysis extends Command
{
    protected $signature = 'agent:analyze';
    protected $description = 'Runs a comprehensive analysis of the codebase.';
    private string $phpPath;

    public function __construct()
    {
        parent::__construct();
        $this->phpPath = (new PhpExecutableFinder())->find(false);
    }

    public function handle()
    {
        $this->info('🚀 Starting Comprehensive Analysis...');
        $this->runComposerAudit();
        $this->runPint();
        $this->runLarastan();
        $this->info('✅ Comprehensive Analysis Finished Successfully.');
        return self::SUCCESS;
    }

    private function runTool(string $message, array $command, ?callable $failureHandler = null)
    {
        $this->line('');
        $this->info($message);
        $process = new Process($command, base_path(), null, null, null);

        try {
            $process->mustRun(function ($type, $buffer) {
                $this->getOutput()->write($buffer);
            });
            $this->info("✅ Tool finished successfully.");
        } catch (ProcessFailedException $exception) {
            if ($failureHandler) {
                $failureHandler($exception);
            } else {
                $this->error('❌ A fatal error occurred during: ' . $message);
                $this->error($exception->getMessage());
                exit(self::FAILURE);
            }
        }
    }

    private function runComposerAudit()
    {
        $this->runTool(
            '🛡️ Running Composer Audit for security vulnerabilities...',
            ['composer', 'audit']
        );
    }

    private function runPint()
    {
        // This approach is cross-platform and avoids .bat file issues on Windows.
        $pintExecutable = base_path('vendor/bin/pint');

        $this->runTool(
            '🎨 Running Laravel Pint for code style...',
            [$this->phpPath, $pintExecutable, '--test', '--verbose'],
            function (ProcessFailedException $exception) {
                if ($exception->getProcess()->getExitCode() === 1) {
                    $this->warn('⚠️  Laravel Pint found style issues to fix. Run `php artisan agent:fix`');
                    return;
                }
                throw $exception;
            }
        );
    }

    private function runLarastan()
    {
        // This approach is also cross-platform.
        $phpstanExecutable = base_path('vendor/bin/phpstan');

        $this->runTool(
            '🔬 Running Larastan for static analysis...',
            [$this->phpPath, $phpstanExecutable, 'analyse', '--no-progress', '--memory-limit=2G']
        );
    }
}
