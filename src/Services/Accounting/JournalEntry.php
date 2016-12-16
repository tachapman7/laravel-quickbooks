<?php

namespace Myleshyson\LaravelQuickBooks\Accounting;

use Myleshyson\LaravelQuickBooks\Quickbooks;

class JournalEntry extends Quickbooks
{
    public function create(array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_JournalEntry();
        $this->resource = new \QuickBooks_IPP_Object_JournalEntry();
        $this->handleTransactionData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);

        return $this->service->add($this->context, $this->realm, $this->resource);
    }

    public function update($id, array $data)
    {
        $this->service = new \QuickBooks_IPP_Service_JournalEntry();
        $this->resource = $this->find($id);

        $this->handleTransactionData($data, $this->resource);
        $this->createLines($data['Lines'], $this->resource);
        return parent::_update($this->context, $this->realm, \QuickBooks_IPP_IDS::RESOURCE_JOURNALENTRY, $this->resource, $id);
    }

    public function delete($id)
    {
        $this->service = new \QuickBooks_IPP_Service_JournalEntry();
        return $this->service->delete($this->context, $this->realm, $id);
    }

    public function find($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM JournalEntry WHERE Id = '$id' ")[0];
    }

    public function get($id)
    {
        return $this->service->query($this->context, $this->realm, "SELECT * FROM JournalEntry")[0];
    }
}
